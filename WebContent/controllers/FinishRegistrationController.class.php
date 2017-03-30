<?php
class FinishRegistrationController {

	public static function run() {
		if (!is_null((array_key_exists('authenticatedUser', $_SESSION))?
		$_SESSION['authenticatedUser']:null)){
			if (!is_null((array_key_exists('registered', $_SESSION))?
			$_SESSION['registered']:null) && $_SESSION['registered'] == 1){
				header('Location: /'.$_SESSION['base'].'/courses');
			}else{
				header('Location: /'.$_SESSION['base'].'/registrationComplete');
			}
		}
		$user = null;
		$userData = null;
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$userPost = null;
			$userDataPost = null;
			if ((!is_null((array_key_exists('user', $_SESSION))?
					$_SESSION['user']:null)) && (!is_null((array_key_exists('userData', $_SESSION))?
					$_SESSION['userData']:null))){
				$userPost = $_POST;
				$userDataPost = $_POST;
				$userPost['userName'] = $_SESSION['user']->getUserName();
				$userDataPost['email'] = $_SESSION['userData']->getEmail();
			}else{
				header('Location: /'.$_SESSION['base'].'/login');
			}
			$user = new User($userPost);
			$userData = new UserData($userDataPost);
			$users = UsersDB::getUsersBy('userName', $user->getUserName());
			if (empty($users))
				header('Location: /'.$_SESSION['base'].'/login');
			
			$formUser = $user;
			$user = $users[0];
			$formUser->setUserId($user->getUserId());
			$user->resetErrors();
			$_SESSION['user'] = $formUser;
			$_SESSION['userData'] = $userData;
			
			if (strcmp(FinishRegistrationController::extractForm($_POST, "password"), FinishRegistrationController::extractForm($_POST, "password_confirm")))
				$formUser->setError('password', 'PASSWORD_MISMATCH');
			
			if ($user->getErrorCount() == 0 && $formUser->getErrorCount() == 0 && $userData->getErrorCount() == 0) {
				UsersDB::updateUser($formUser);
				UserDataDB::updateUserData($user, $userData);
				$_SESSION['authenticatedUserData'] = $userData;
				$_SESSION['authenticatedUser'] = $user;
				RegistrationDB::addRegistration($users[0]);
				if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
					pclose(popen("start \"bla\" \"" . 'C:\Python27\python.exe' . "\" " . escapeshellcmd(dirname(__FILE__) . DIRECTORY_SEPARATOR . '../resources/register.py '.$user->getUserName().' '.$userData->getEmail().' '.$userData->getVMPassword().' '.$user->getUserId()), "r"));
				}else{
					$registerCMD = escapeshellcmd('/usr/bin/python ' . dirname(__FILE__) . DIRECTORY_SEPARATOR . '../resources/register.py '.$user->getUserName().' '.$userData->getEmail().' '.$userData->getVMPassword().' '.$user->getUserId())." ";
					$registerCMD .= '> /dev/null 2>&1 &';
					exec($registerCMD, $output, $exit);
				}
				header('Location: /'.$_SESSION['base'].'/courses');
			} else  
				RegistrationFinishView::show($user, $userData);
		} else {  // Initial link
			$_SESSION['user']->resetErrors();
			$_SESSION['userData']->resetErrors();
			$_SESSION['fb_access_token'] = null;
			RegistrationFinishView::show();
		}
	}
	
	protected function extractForm($formInput, $valueName) {
		// Extract a stripped value from the form array
		$value = "";
		if (isset($formInput[$valueName])) {
			$value = trim($formInput[$valueName]);
			$value = stripslashes ($value);
			$value = htmlspecialchars ($value);
			return $value;
		}
	}
}
?>