<?php
class TopicsController {
	public static function run() {
		if (!is_null((array_key_exists('authenticatedUser', $_SESSION))?
		$_SESSION['authenticatedUser']:null)) {
			if (!is_null((array_key_exists('registered', $_SESSION))?
			$_SESSION['registered']:null) && $_SESSION['registered'] == 1){
				$parsed = parse_url($_SERVER['REQUEST_URI']);
				$topic = (array_key_exists('query', $parsed))?
					$parsed['query']:null;
				
				//Verify that the user has access to this topic by querying the API
				$pathDir = dirname(__FILE__);  //Initialize the path directory
				$fullPath = $pathDir . DIRECTORY_SEPARATOR . "../resources/courseData/topics/";
				if (file_exists($fullPath) && is_dir($fullPath)){
					$files = scandir($fullPath);
					$files = array_diff($files, array('.', '..'));
				}
				$instances = OCI_API::getInstances($_SESSION['authenticatedUser']->getUserId());
				$flag = true;
				foreach($files as $file) {
					$yaml = Spyc::YAMLLoad($fullPath.$file);
					if (!is_null($instances) && array_key_exists($yaml[0]['image'], $instances)) {
						TopicView::show($topic);
						$flag = false;
						break;
					}
				}
				if ($flag)
					header('Location: /'.$_SESSION['base'].'/courses');
			}else{
				header('Location: /'.$_SESSION['base'].'/registrationComplete');
			}
		} else {
			header('Location: /'.$_SESSION['base'].'/login');
		}
	}
}
?>