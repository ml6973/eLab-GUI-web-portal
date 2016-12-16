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
  	
  	//Get all marketPlace and courseObjects
  	$allObjects = iterator_to_array($courses->find( array("identifier" => "marketPlaceObject") ));
  	$allObjects = array_merge($allObjects, iterator_to_array($courses->find( array("identifier" => "courseObject") )));
  	
  	//Create an array, differentiated by category
  	$categoriedObjects = array();
  	foreach ($allObjects as $object) {
  		if (!array_key_exists($object["category"], $categoriedObjects)) {
  			$categoriedObjects[$object["category"]] = array();
  		}
  		$categoriedObjects[$object['category']][] = $object;
  	}
  	
  	//Sort each category's objects by content type
  	foreach ($categoriedObjects as $category => $object){
  		foreach ($object as $key => $row) {
  			$title[$key] = $row['title'];
  		}
  		array_multisort($title , SORT_NATURAL, $object);
  		$categoriedObjects[$category] = $object;
  	}
  	
  	/*foreach ($categoriedObjects as $category => $object){
  		$typeArray = array();
  		foreach ($object as $course) {
	  		if (!array_key_exists($course["contentType"], $typeArray)) {
	  			$typeArray[$course["contentType"]] = array();
	  		}
	  		$typeArray[$course['contentType']][] = $course;
  		}
  		ksort($typeArray, SORT_NATURAL);
  		$categoriedObjects[$category] = $typeArray;
  	}*/
  	
 /* 	foreach ($categoriedObjects as $category => $object){
  		echo "<br>". $category ."<br>";
  		print_r($object);
  	}*/
  	
  	foreach($categoriedObjects as $objects){
  		//foreach ($types as $objects){
	  	foreach($objects as $course) {
	  	
	  		if (!is_null($instances)) {
	  			if (strcmp($course['contentType'], "course") == 0) {
		  			echo '<div class="container">';
	  				$courseCat = preg_replace("/[_]/s", " ", $course['category']);
	  				$courseSubtitle = ucwords($courseCat." ".$course['contentType']);
		  			echo '
		  				<div class="row">
							<h2 class="text-left pull-left" style="padding-left: 20px;">'.$course['title'].'</h2>
							<h5 class="pull-right" style="color: grey; padding-left: 20px; padding-right: 15px; padding-top: 18px">'.$courseSubtitle.'</h2><br>
		  				</div>';
		  			$description = preg_split('/\n/', $course['description']);
		  			foreach ($description as $sentence) {
		  				echo '<p>'.$sentence.'</p>';
		  			}
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
	  							echo '</div>';
	  					if (strcmp($course['identifier'], "courseObject") == 0) {
					  		echo '<br><br><br>
							<div class="col-md-8">';
							
								foreach($course["topics"] as $topicObject) {
									$topic = $courses->findOne( array("_id" => $topicObject));
									echo '
						           <h3><ul>
							        	<div>';
									if (!is_null($instances) && array_key_exists($course['image'], $instances))
								    		echo '<a href="topics?'.$topic["_id"].'" >   <i class="fa fa-flask" aria-hidden="true"></i> '.$topic["title"].'</a>';
									else
											echo ' '.$topic["title"].'';
								    echo '<!--description
						            <p>'.$topic["description"].'</p>
						            -->
								    	</div>
						          </ul></h3>';
								}
								echo '
						    	<br><br>';
						}elseif (strcmp($course['identifier'], "marketPlaceObject" == 0)){
							$children = iterator_to_array($courses->find( array("identifier" => "applicationObject", "parent" => $course['image']) ));
							echo '<br><br><br>
							<div class="col-md-8">';
							
							if (!empty($children)){
								//Sort the applications by name
								foreach ($children as $key => $row) {
									$child[$key] = $row['title'];
								}
								array_multisort($child , SORT_NATURAL, $children);
								echo '<h4>Applications crafted from this course:</h4>';
							//	<a href="/'.$base.'/posts?'.$topicObject['_id']."&".$postObject['_id'].'"><i class="fa fa-flask" aria-hidden="true"></i> '.$postObject['title'].'</a>
								foreach($children as $app) {
									echo '
							           <h3><ul>
								        	<div>';
									if (!is_null($instances) && array_key_exists($course['image'], $instances))
										echo '<a href="'.$app["ip"].'" >   <i class="fa fa-play" aria-hidden="true"></i> '.$app["title"].'</a>';
										else
											echo ' '.$app["title"].'';
											echo '</div>
							          </ul></h3>';
								}
							}
							echo '
						    	<br><br>';
						}
				echo '</div>
					</div><br><br>';
	  			}/* elseif (strcmp($course['contentType'], "application") == 0) {
	  				$courseCat = preg_replace("/[_]/s", " ", $course['category']);
	  				$courseSubtitle = ucwords($courseCat." ".$course['contentType']);
	  				echo '<div class="container">
						  <div class="row">
							<h2 class="text-left pull-left" style="padding-left: 20px;">'.$course['title'].'</h2>
							<h5 class="pull-right" style="color: grey; padding-left: 20px; padding-right: 15px; padding-top: 18px">'.$courseSubtitle.'</h2><br>
		  				  </div>
					      <div class="col-md-3 pull-right" style="" ng-include>';
	  						if (!is_null($instances) && array_key_exists($course['image'], $instances))
	  							vmInfo::showCustomApplication($course['image'], $course['type']);
	  							else
	  								vmInfo::showDisabledApplication();
	  								echo '</div>
					</div><br><br>';
	  			}*/
	  		}
	  	
	  	}
  	} //}	
  	 
/*  	$courseObjects = $courses->find( array("identifier" => "courseObject") );
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
  	} */
  	
  }
}
?>