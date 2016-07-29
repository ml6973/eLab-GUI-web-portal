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
  	$pathDir = dirname(__FILE__);  //Initialize the path directory
  	$fullPath = $pathDir . DIRECTORY_SEPARATOR . "../resources/courseData/courses/";
  	
  	if (file_exists($fullPath) && is_dir($fullPath)){
  		$files = scandir($fullPath);
  		$files = array_diff($files, array('.', '..'));
  		sort($files, SORT_REGULAR | SORT_NATURAL);
  	}
  	
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
			        	<div>
				    		<a href="topics?'.$topic["link"].'" >  <h3> - '.$topic["title"].'</h3></a>
				    		<!--description
		            <p>'.$topic["description"].'</p>
		            -->
				    	</div>
		          </ul>';
				}
				echo '
		    	<br><br>
			</div>
			<div class="col-md-3" ng-include>';
				vmInfo::show($courseYaml[0]['image']);
			echo '</div>
		</div>';
  	}
  }
}
?>