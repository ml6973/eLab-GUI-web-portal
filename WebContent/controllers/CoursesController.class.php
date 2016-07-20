<?php
class CoursesController {
	public static function run() {
		if (!is_null((array_key_exists('authenticatedUser', $_SESSION))?
		$_SESSION['authenticatedUser']:null)) {
			CoursesView::show();
		} else {
			header('Location: /'.$_SESSION['base'].'/login');
		}
	}
}
?>