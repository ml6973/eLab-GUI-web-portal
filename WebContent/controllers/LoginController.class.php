<?php
class LoginController {

	public static function run() {
		if (!is_null((array_key_exists('authenticatedUser', $_SESSION))?
		$_SESSION['authenticatedUser']:null))
			header('Location: /'.$_SESSION['base'].'/courses');
		$user = null;
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$user = new User($_POST);  
			$users = UsersDB::getUsersBy('userName', $user->getUserName());
			if (empty($users))
				$user->setError('userName', 'USER_NAME_DOES_NOT_EXIST');
			else {
				if (strcmp($user->getPasswordHash(), $users[0]->getPasswordHash()) != 0)
				if (!$user->verifyPassword($users[0]->getPasswordHash()))
					$user->setError('password', 'PASSWORD_INCORRECT');
				else
					$user = $users[0];
			}
		}
		$_SESSION['user'] = $user;
		if (is_null($user) || $user->getErrorCount() != 0) {
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