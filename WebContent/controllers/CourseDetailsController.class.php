<?php
class CourseDetailsController {
	public static function run() {
		$parsed = parse_url($_SERVER['REQUEST_URI']);
		$course = (array_key_exists('query', $parsed))?
			$parsed['query']:null;
		CourseDetailsView::show($course);
	}
}
?>
