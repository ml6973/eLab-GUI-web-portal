<?php
class LoginController {

	public static function run() {
		if (!is_null((array_key_exists('authenticatedUser', $_SESSION))?
		$_SESSION['authenticatedUser']:null)){
			$_SESSION['registered'] = RegistrationDB::getRegistrationRowSetsBy('userId', $_SESSION['authenticatedUser']->getUserId());
			if (!is_null((array_key_exists('registered', $_SESSION))?
			$_SESSION['registered']:null) && $_SESSION['registered'] == 1){
				header('Location: /'.$_SESSION['base'].'/courses');
			}else{
				header('Location: /'.$_SESSION['base'].'/registrationComplete');
			}
		}
		$user = null;
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			print_r(" "); //fixes connection reset on login?
			$user = new User($_POST);  
			$users = UsersDB::getUsersBy('userName', $user->getUserName());
			if (empty($users))
				$user->setError('userName', 'USER_NAME_DOES_NOT_EXIST');
			else if (!empty($users[0]->getFacebookId())) {
				$user->setError('userName', 'USER_SIGN_IN_FACEBOOK');
			} else {
				if (strcmp($user->getPasswordHash(), $users[0]->getPasswordHash()) != 0)
				if (!$user->verifyPassword($users[0]->getPasswordHash()))
					$user->setError('password', 'PASSWORD_INCORRECT');
				else
					$user = $users[0];
			}
		}
		$_SESSION['user'] = $user;
		if (is_null($user) || $user->getErrorCount() != 0) {
			$_SESSION['fb_access_token'] = null;
			loginView::show($user);
		} else {
			$userData = UserDataDB::getUserDataBy('userId', $user->getUserId());
			$userData[0]->resetErrors();
			$_SESSION['authenticatedUserData'] = $userData[0];
			$_SESSION['authenticatedUser'] = $user;
    		header('Location: /'.$_SESSION['base'].'/courses');
	    }
	}
}
?>