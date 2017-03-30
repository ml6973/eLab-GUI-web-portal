<?php
	ob_start();
	include("includer.php");
	
	require_once __DIR__ . '/libraries/facebook-sdk-v5/autoload.php';
	
	session_start();   
	$url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
	list($fill, $base, $control, $action, $arguments) =
			explode('/', $url, 5) + array("", "", "", "", null);
	$_SESSION['base'] = $base;
	$_SESSION['control'] = $control; 
	$_SESSION['action'] = $action;
	$_SESSION['arguments'] = $arguments;
	if (!isset($_SESSION['authenticated']))
		$_SESSION['authenticated'] = false;
	switch ($control) {
		case "login": 
			LoginController::run();
			break;
		case "fblogin":
			FBLoginController::run();
			break;
		case "logout" :
			LogoutController::run ();
			break;
		case "registration":
			RegistrationController::run();
			break;
		case "registrationComplete":
			RegistrationCompleteController::run();
			break;
		case "finishRegistration":
			FinishRegistrationController::run();
			break;
		case "marketplace":
			MarketPlaceController::run();
			break;
		case "course_details":
			CourseDetailsController::run();
			break;
		case "courses":
			CoursesController::run();
			break;
		case "topics":
			TopicsController::run();
			break;
		case "posts":
			PostsController::run();
			break;
		default:
			MarketPlaceController::run();
	};
	ob_end_flush();
?>