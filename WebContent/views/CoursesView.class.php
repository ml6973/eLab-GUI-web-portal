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
	  		
  	//Get connection and select the collection
  	$db = MongoDatabase::getConnection();
  	$courses = $db->selectCollection('courseData');
  	$gridFS = $db->getGridFS();
  	
  	$courseObjects = $courses->find( array("identifier" => "marketPlaceObject") );
  	foreach($courseObjects as $course) {
  	
  		if (!is_null($instances)) {
  			if (strcmp($course['contentType'], "course") == 0) {
	  			echo '<div class="container">
					<h2 class="text-left">'.$course['title'].'</h2><br>';
	  			if (is_array($course["description"])){
	  				foreach ($course["description"] as $sentence) {
	  					echo '<p>'.$sentence.'</p>';
	  				}
	  			}else
	  				echo '<p>'.$course["description"].'</p>';
	  				echo '<br><div class="col-md-3 pull-left">';
	  				if (array_key_exists('link', $course) && !empty($course["link"])) {
	  					echo '<a class="btn btn-primary btn-block btn-lg" href="'.$course['link'].'" role="button">Access Course</a>';
	  				}else
	  					echo '<br><br>';
	  					echo '</div>
					<div class="col-md-3 pull-right" ng-include>';
	  					if (!is_null($instances) && array_key_exists($course['image'], $instances))
	  						vmInfo::showCustom($course['image'], $course['type']);
	  						else
	  							vmInfo::showDisabled();
	  							echo '</div>
				</div>';
  			} elseif (strcmp($course['contentType'], "application") == 0) {
  				echo '<div class="container">
				<h2 class="text-left" style="display: inline-block;">'.$course['title'].'</h2>
				<div class="col-md-3 pull-right" style="padding-top: 14px;" ng-include>';
  						if (!is_null($instances) && array_key_exists($course['image'], $instances))
  							vmInfo::showCustomApplication($course['image'], $course['type']);
  							else
  								vmInfo::showDisabledApplication();
  								echo '</div>
				</div>';
  			}
  		}
  	
  	}
  	 
  	$courseObjects = $courses->find( array("identifier" => "courseObject") );
  	foreach($courseObjects as $course) {
  		
	  	echo '<div class="container">
			<h2 class="text-left">'.$course['title'].'</h2>
		  <p>'.$course['description'].'</p>';
		  	echo '<br><div class="col-md-3 pull-left">';
		  	if (array_key_exists('link', $course) && !empty($course["link"])) {
		  		echo '<a class="btn btn-primary btn-block btn-lg" href="'.$course['link'].'" role="button">Access Course</a>';
		  	}else
		  		echo '<br><br>';
		  	echo '</div>
		  	<div class="col-md-3 pull-right" ng-include>';
				if (!is_null($instances) && array_key_exists($course['image'], $instances) && array_key_exists('type', $course))
					vmInfo::showCustom($course['image'], $course['type']);
				else if (!is_null($instances) && array_key_exists($course['image'], $instances))
					vmInfo::show($course['image']);
				else
					vmInfo::showDisabled();
			echo '</div><br><br><br>
			<div class="col-md-8">';
			
				foreach($course["topics"] as $topicObject) {
					$topic = $courses->findOne( array("_id" => $topicObject));
					echo '
		           <ul>
			        	<div>';
					if (!is_null($instances) && array_key_exists($course['image'], $instances))
				    		echo '<a href="topics?'.$topic["_id"].'" >  <h3> - '.$topic["title"].'</h3></a>';
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
		</div>';
  	}
  	
  }
}
?>