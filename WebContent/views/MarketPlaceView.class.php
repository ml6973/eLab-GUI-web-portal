<?php
class MarketPlaceView {
  public static function show() {
	  MasterView::showHeader();
	  MasterView::showNavBar();
	  MarketPlaceView::showDetails();
	  MasterView::showFooter();
  }

  public static function showDetails() {
  	$base = $_SESSION['base'];
  	$pathDir = dirname(__FILE__);  //Initialize the path directory

  	echo '
  	<link rel="stylesheet" href="css/marketplace.css">
	<!--Banner-->
	<div class="jumbotron">
	   	<div class="container">
	       <div class="title" id="welcome">Welcome to Open Cloud Marketplace!</div>
           <div class="slogan">Hands-on learning powered by personal environments.</div>
	       <!--	<p>Everyone knows about the giant skills gap that is haunting the IT sector worldwide. Powered by Chameleon Cloud, eLab cloud based learning platform helps you achieve certification for today\'s tech job.</p> -->
	       <!--	<p><a class="btn btn-primary btn-md" href="/#/about" role="button">Learn more &raquo;</a></p> -->
	    </div>
	</div>';

  	$fullPath = $pathDir . DIRECTORY_SEPARATOR . "../resources/marketPlaceData/";

  	if (file_exists($fullPath) && is_dir($fullPath)){
  		$files = scandir($fullPath);
  		$files = array_diff($files, array('.', '..'));
  	}

	echo '

  	<div class="container">
  		<div class="row">';

	foreach($files as $file) {
		if (file_exists($fullPath.$file.DIRECTORY_SEPARATOR."header.yaml") && file_exists($fullPath.$file.DIRECTORY_SEPARATOR."details.md") && file_exists($fullPath.$file.DIRECTORY_SEPARATOR."thumbnail.jpg")) {
			$marketYaml = Spyc::YAMLLoad($fullPath.$file.DIRECTORY_SEPARATOR."header.yaml");
			if (array_key_exists('markettitle', $marketYaml[0])) {
				echo '
	  			<div class="col-sm-6 col-md-4 col-lg-3">
					<div class="thumbnail">
						<a href="course_details?'.$file.'" class="">
							<img src="/'.$base.'/resources/marketPlaceData/'.$file.'/thumbnail.jpg" alt="Thumbnail">
							<div class="partner"><span>'.$marketYaml[0]['organization'].'</span></div>
							<div class="coursetitle">'.$marketYaml[0]['markettitle'].'</div>';
						if (strcmp($marketYaml[0]['lessoncount'], "1") == 0) {
						   echo '<div class="footer"><span>1 Lesson</span></div>';
						}else {
							echo '<div class="footer"><span>'.$marketYaml[0]['lessoncount'].' Lessons</span></div>';
						}
			echo		'</a>
					 </div>
				</div>';

			}
		}
	}
	
	echo '<div class="col-sm-6 col-md-4 col-lg-3">
					<div class="thumbnail">
						<img src="/'.$base.'/resources/marketPlaceData/coming_soon/thumbnail.jpg" alt="Thumbnail">
						<div class="partner"><span>The University of Texas at San Antonio</span></div>
						<div class="coursetitle">Cyber Security</div>
						<div class="footer"><span>Coming Soon...</span></div>
					 </div>
		  </div>';

  	echo '</div>
  	</div>

	';

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
