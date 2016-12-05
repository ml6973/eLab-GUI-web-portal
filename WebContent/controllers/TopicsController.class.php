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
				
				//Get connection and select the collection
			  	$db = MongoDatabase::getConnection();
			  	$courses = $db->selectCollection('courseData');
			  	$courseObjects = $courses->find( array("identifier" => "courseObject") );
  	
				$instances = OCI_API::getInstances($_SESSION['authenticatedUser']->getUserId());
				$flag = true;
				foreach($courseObjects as $courseObject) {
					if (!is_null($instances) && array_key_exists($courseObject['image'], $instances)) {
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