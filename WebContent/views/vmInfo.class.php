<?php
class vmInfo {
	public static function show($imageName) {
		$userId = $_SESSION['authenticatedUser']->getUserID();
		echo '<p><a class="btn btn-success btn-block btn-lg vmIP" id="'.$imageName.'" data-uid="'.$userId.'" role="button">Get IP</a></p>';
	}
}
?>