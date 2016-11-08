<?php
class FBLoginController {

	public static function run() {
		
		if (is_null((array_key_exists('authenticatedUser', $_SESSION))?
		$_SESSION['authenticatedUser']:null)){
			if (!is_null((array_key_exists('fb_access_token', $_SESSION))?
					$_SESSION['fb_access_token']:null)){
				$fb = new Facebook\Facebook([
						'app_id' => '1778791989060640',
						'app_secret' => '561f5ac04a6101c6d917b71ecb2c4ed6',
						'default_graph_version' => 'v2.2',
				]);
				$oAuth2Client = $fb->getOAuth2Client();
				$expires = time() + 60 * 60 * 2;
				$accessToken = new Facebook\Authentication\AccessToken($_SESSION['fb_access_token'], $expires);
				$tokenMetadata = $oAuth2Client->debugToken($accessToken);
				$users = UsersDB::getUsersBy('facebookId', $tokenMetadata->getUserId());
				if (empty($users)){
					if ($_SERVER["REQUEST_METHOD"] == "POST") {
						$user = new User($_POST);
						$userData = new UserData($_POST);
						$users = UsersDB::getUsersBy('userName', $user->getUserName());
						if (!empty($users))
							$user->setError('userName', 'DISPLAY_NAME_ALREADY_EXISTS');
								
						$_SESSION['user'] = $user;
						$_SESSION['userData'] = $userData;
							
						if ($user->getErrorCount() == 1 && empty($user->getError('username')) && $userData->getErrorCount() == 0) {
							$user->resetErrors();
							$user->setFacebookId($tokenMetadata->getUserId());
							$userId = UsersDB::addUser($user);
							$user->setUserId($userId);
							UserDataDB::addUserData($user, $userData);
							$_SESSION['authenticatedUserData'] = $userData;
							$_SESSION['authenticatedUser'] = $user;
							RegistrationDB::addRegistration($user);
							if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
								pclose(popen("start \"bla\" \"" . 'C:\Python27\python.exe' . "\" " . escapeshellcmd(dirname(__FILE__) . DIRECTORY_SEPARATOR . '../resources/register.py '.$user->getUserName().' '.$userData->getEmail().' '.$userData->getVMPassword().' '.$user->getUserId()), "r"));
							}else{
								$registerCMD = escapeshellcmd('/usr/bin/python ' . dirname(__FILE__) . DIRECTORY_SEPARATOR . '../resources/register.py '.$user->getUserName().' '.$userData->getEmail().' '.$userData->getVMPassword().' '.$user->getUserId());
								$registerCMD .= '> /dev/null 2>&1 &';
								exec($registerCMD, $output, $exit);
							}
							header('Location: /'.$_SESSION['base'].'/courses');
						} else
							FBFinishView::show();
					}else{
						$_SESSION['user'] = null;
						$_SESSION['userData'] = null;
						FBFinishView::show();
					}
				}else {
					$user = $users[0];
					$_SESSION['user'] = $user;
					$userData = UserDataDB::getUserDataBy('userId', $user->getUserId());
					$userData[0]->resetErrors();
					$_SESSION['authenticatedUserData'] = $userData[0];
					$_SESSION['authenticatedUser'] = $user;
					header('Location: /'.$_SESSION['base'].'/courses');
				}
			}else{
				header('Location: /'.$_SESSION['base'].'/login');
			}
		}else{
			header('Location: /'.$_SESSION['base'].'/courses');
		}
	}
}
?>