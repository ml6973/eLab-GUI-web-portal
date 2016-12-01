<?php
class CourseDetailsView {
  public static function show($course) {
	  MasterView::showHeader();
	  MasterView::showNavBar();
	  CourseDetailsView::showDetails($course);
	  MasterView::showFooter();
  }

  public static function showDetails($courseDir) {
  	$base = $_SESSION['base'];
  	$pathDir = dirname(__FILE__);  //Initialize the path directory
  	
  	//Build Object ID from parameter
  	$object = new MongoId($courseDir);
  	
  	//Get connection and select the collection we will store the course data
  	$db = MongoDatabase::getConnection();
	$courses = $db->selectCollection('courseData');
	$gridFS = $db->getGridFS();
	$course = $courses->findOne(array("_id" => $object));

    echo '
   <head>
   <!-- CSS -->
   <link rel="stylesheet" href="css/course_details_style.css">
   </head>

   <!--Banner-->
   <div class="jumbotron" style="background-image: url(data:image/jpg;base64,'.base64_encode($gridFS->findOne(array("_id" => $course['thumbnail']))->getBytes()).')">
   <div class="courseTitle"><h1>'.$course['title'].'</h1></div>
   </div>';

   $organizationImage = preg_replace('/\s/', '_', $course['organization']).".jpg";
   $organizationImagePath = $pathDir . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "resources" . DIRECTORY_SEPARATOR . "organizations" .DIRECTORY_SEPARATOR. $organizationImage;
   if (file_exists($organizationImagePath)) {
   		echo '
   		<div class="organization">
        <p>Created by:
        	<img id = "organizationImage" src="/'.$base.'/resources/organizations/'.$organizationImage.'" alt="'.$course['organization'].'"></p>
        </div>
        ';
	} else {
    	echo '
        <div class="organization">
        	<p>Created by: '.$course['organization'].'</p>
        </div>
        ';
	}

    echo '<div class="courseDetails">';
    $ParseDown = new ParsedownExtra();
    $courseContents = $gridFS->findOne(array("_id" => $course['details']))->getBytes();
    echo $ParseDown->text($courseContents);
    echo '</div>';

  }
}
?>
