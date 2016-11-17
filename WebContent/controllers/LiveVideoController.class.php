<?php
class LiveVideoController {
	public static function run() {
		//$parsed = parse_url($_SERVER['REQUEST_URI']);
		LiveVideoView::show();
	}
}
?>