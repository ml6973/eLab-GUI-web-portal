<?php
class LogoutController {

	public static function run() {
		$base = (array_key_exists('base', $_SESSION))? $_SESSION['base']: "";
		session_unset();
		session_destroy();
		session_start();
		$_SESSION['authenticatedUser'] = null;
		$_SESSION['registered'] = null;
		$_SESSION['fb_access_token'] = null;
		header("Location: /$base");
	}
}

?>