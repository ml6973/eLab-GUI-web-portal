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

    $fullPath = $pathDir . DIRECTORY_SEPARATOR . "..".DIRECTORY_SEPARATOR."resources".DIRECTORY_SEPARATOR."marketPlaceData".DIRECTORY_SEPARATOR;


    // Get the course directory
  	if (!(file_exists($fullPath) && is_dir($fullPath))){
        echo 'invalid course';
        return;
    }

    //Go through the course directory and display course Info
    if (file_exists($fullPath.$courseDir.DIRECTORY_SEPARATOR."header.yaml") && file_exists($fullPath.$courseDir.DIRECTORY_SEPARATOR."details.md") && file_exists($fullPath.$courseDir.DIRECTORY_SEPARATOR."thumbnail.jpg")) {
        $courseYaml = Spyc::YAMLLoad($fullPath.$courseDir.DIRECTORY_SEPARATOR."header.yaml");
        if (array_key_exists(('title'), $courseYaml[0])) {
          	echo '
            <head>
            <!-- CSS -->
            <link rel="stylesheet" href="css/course_details_style.css">
            </head>

        	<!--Banner-->
        	<div class="jumbotron" style="background-image: url(/eLab-GUI-web-portal/resources/marketPlaceData/'.$courseDir.'/thumbnail.jpg);">
                <div class="courseTitle"><h1>'.$courseYaml[0]['title'].'</h1></div>
        	</div>';

            $organizationImage = preg_replace('/\s/', '_', $courseYaml[0]['organization']).".jpg";
            $organizationImagePath = $pathDir . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "resources" . DIRECTORY_SEPARATOR . "organizations" .DIRECTORY_SEPARATOR. $organizationImage;
            if (file_exists($organizationImagePath)) {
                echo '
                <div class="organization">
                    <p>Created by:
                    <img id = "organizationImage" src="/'.$base.'/resources/organizations/'.$organizationImage.'" alt="'.$courseYaml[0]['organization'].'"></p>
                </div>
                ';
            } else {
                echo '
                <div class="organization">
                    <p>Created by: '.$courseYaml[0]['organization'].'</p>
                </div>
                ';
            }

            echo '<div class="courseDetails">';
            $ParseDown = new ParsedownExtra();
            $courseContents = file_get_contents($fullPath.$courseDir.DIRECTORY_SEPARATOR."details.md");
            echo $ParseDown->text($courseContents);
            echo '</div>';

        }
    }

  }
}
?>
