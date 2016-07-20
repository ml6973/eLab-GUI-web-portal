<?php
class PostsController {
	public static function run() {
		if (!is_null((array_key_exists('authenticatedUser', $_SESSION))?
		$_SESSION['authenticatedUser']:null)) {
			$parsed = parse_url($_SERVER['REQUEST_URI']);
			if (is_null((array_key_exists('query', $parsed))?$parsed['query']:null)) {
				PostView::show(null, null);
			}else{
				$parsed = explode('&', $parsed["query"]);
				if (count($parsed) != 2) {
					$topic = null;
					$post = null;
				}else{
					$topic = $parsed[0];
					$post = $parsed[1];
				}
				PostView::show($topic, $post);
			}
		} else {
			header('Location: /'.$_SESSION['base'].'/login');
		}
	}
}
?>