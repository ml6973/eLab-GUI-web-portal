<?php
class vmInfo {
	public static function show($imageName) {
		$userName = $_SESSION['authenticatedUser']->getUserName();
		$userId = $_SESSION['authenticatedUser']->getUserID();
		echo '<p><a class="btn btn-success btn-block btn-lg vmIP" id="'.$imageName.'" data-uname="'.$userName.'" data-uid="'.$userId.'" role="button">Access Lab Machine</a></p>';
		echo '<div class="row" id="'.$imageName.'_info" hidden>
				<p>Copy this command into your terminal: </p>
				<p><input class="form-control" id="'.$imageName.'_command" type="text" value="" readonly="readonly"></p>
			 </div>';
	}
}
?>