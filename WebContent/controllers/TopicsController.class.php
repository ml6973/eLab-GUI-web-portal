<?php
class TopicsController {
	public static function run() {
		if (!is_null((array_key_exists('authenticatedUser', $_SESSION))?
		$_SESSION['authenticatedUser']:null)) {
			$parsed = parse_url($_SERVER['REQUEST_URI']);
			$topic = (array_key_exists('query', $parsed))?
				$parsed['query']:null;
			TopicView::show($topic);
		} else {
			header('Location: /'.$_SESSION['base'].'/login');
		}
	}
}
?>