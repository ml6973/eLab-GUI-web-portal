<?php
class CourseDetailsView {
  public static function show($course) {
	  MasterView::showHeader();
	  MasterView::showNavBar();
	  CourseDetailsView::showDetails($course);
	  MasterView::showFooter();
  }

  public static function showDetails($course) {
  	$base = $_SESSION['base'];
  	$pathDir = dirname(__FILE__);  //Initialize the path directory

    $fullPath = $pathDir . DIRECTORY_SEPARATOR . "../resources/marketPlaceData/";

    // Get the course directory
  	if (file_exists($fullPath) && is_dir($fullPath)){
        $courseDir = "/machinelearning-paul_rad";
  	} else {
        echo 'invalid course';
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
        	<div class="jumbotron" style="background-image: url(/eLab-GUI-web-portal/resources/siteImages/classRoom.jpg);">
                <div class="courseTitle"><h1>'.$courseYaml[0]['title'].'</h1></div>
        	</div>';

            echo '<div class="courseDetails">';
            $ParseDown = new ParsedownExtra();
            $courseContents = file_get_contents($fullPath.$courseDir.DIRECTORY_SEPARATOR."details.md");
            echo $ParseDown->text($courseContents);
            echo '</div>';

            //Footer
            echo '
            <div class="organization">
                <p>'.$courseYaml[0]['organization'].'</p>
            </div>
            ';
        }
    }


  /*	$fullPath = $pathDir . DIRECTORY_SEPARATOR . "../resources/customCourseData/";

  	if (file_exists($fullPath) && is_dir($fullPath)){
  		$files = scandir($fullPath);
  		$files = array_diff($files, array('.', '..'));
  	}

  	foreach($files as $file) {

  		$courseYaml = Spyc::YAMLLoad($fullPath.$file);

  		if (!is_null($instances) && array_key_exists($courseYaml[0]['image'], $instances)) {
	  		echo '<div class="container">
				<h2 class="text-left">'.$courseYaml[0]['title'].'</h2><br>';
	  			if (is_array($courseYaml[0]["description"])){
	  				foreach ($courseYaml[0]["description"] as $sentence) {
	  					echo '<p>'.$sentence.'</p>';
	  				}
	  			}else
	  				echo '<p>'.$courseYaml[0]["description"].'</p>';
				echo '<br><div class="col-md-8">';
	  		echo '
			    <br><br>
				</div>
				<div class="col-md-3" ng-include>';
	  		if (!is_null($instances) && array_key_exists($courseYaml[0]['image'], $instances))
	  			vmInfo::showCustom($courseYaml[0]['image'], $courseYaml[0]['type']);
	  			echo '</div>
			</div>';
  		}
  	}

  	$fullPath = $pathDir . DIRECTORY_SEPARATOR . "../resources/courseData/courses/";

  	if (file_exists($fullPath) && is_dir($fullPath)){
  		$files = scandir($fullPath);
  		$files = array_diff($files, array('.', '..'));
  		sort($files, SORT_REGULAR | SORT_NATURAL);
  	}

  	foreach($files as $file) {

  		$courseYaml = Spyc::YAMLLoad($fullPath.$file);

	  	echo '<div class="container">
			<h2 class="text-left">'.$courseYaml[0]['title'].'</h2>
		  <p>'.$courseYaml[0]['description'].'</p>
			<br>
			<div class="col-md-8">';
				$fileName = $pathDir . DIRECTORY_SEPARATOR . "../resources/courseData/topics/" . $courseYaml[0]['topicFile'];
				$yaml = Spyc::YAMLLoad($fileName);
				foreach($yaml as $topic) {
					echo '
		           <ul>
			        	<div>';
					if (!is_null($instances) && array_key_exists($courseYaml[0]['image'], $instances))
				    		echo '<a href="topics?'.$topic["link"].'" >  <h3> - '.$topic["title"].'</h3></a>';
					else
							echo '<h3> - '.$topic["title"].'</h3>';
				    echo '<!--description
		            <p>'.$topic["description"].'</p>
		            -->
				    	</div>
		          </ul>';
				}
				echo '
		    	<br><br>
			</div>
			<div class="col-md-3" ng-include>';
				if (!is_null($instances) && array_key_exists($courseYaml[0]['image'], $instances))
					vmInfo::show($courseYaml[0]['image']);
				else
					vmInfo::showDisabled();
			echo '</div>
		</div>';
  	}
  	*/
  }
}
?>
