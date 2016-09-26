<?php
class CoursesView {
  public static function show() { 
	  MasterView::showHeader();
	  MasterView::showNavBar();
	  CoursesView::showDetails();
	  MasterView::showFooter();
  }

  public static function showDetails() {
  	$base = $_SESSION['base'];
  	$instances = OCI_API::getInstances($_SESSION['authenticatedUser']->getUserId());
  	$pathDir = dirname(__FILE__);  //Initialize the path directory
  	
  	echo '
	<script src="js/getVMIP.js"></script>
	<!--Banner-->
	<div class="jumbotron">
	   	<div class="container">
	       	<h1 id="welcome">Welcome to Open Cloud eLab!</h1>
	       	<p>Everyone knows about the giant skills gap that is haunting the IT sector worldwide. Powered by Chameleon Cloud, eLab cloud based learning platform helps you achieve certification for today\'s tech job.</p>
	       <!--	<p><a class="btn btn-primary btn-md" href="/#/about" role="button">Learn more &raquo;</a></p> -->
	    </div>
	</div>';
  	
  	$fullPath = $pathDir . DIRECTORY_SEPARATOR . "../resources/customCourseData/";
  	 
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
  }
}
?>