<?php
class PostView {
  public static function show($topic, $post) { 
	  MasterView::showHeader();
	  MasterView::showNavBar();
	  PostView::showDetails($topic, $post);
	  MasterView::showFooter();
  }

  public static function showDetails($topic, $post) {
  	$base = $_SESSION['base'];
  	$number = 0;
  	
  	//Get connection and select the collection
  	$db = MongoDatabase::getConnection();
  	$courses = $db->selectCollection('courseData');
  	$gridFS = $db->getGridFS();
  	
  	//Build Object IDs from parameter
  	$topicObjectId = null;
  	$postObjectId = null;
  	try {
  		$topicObjectId = new MongoId($topic);
  		$postObjectId = new MongoId($post);
  	} catch (MongoException $e) {
  		$topicObjectId = null;
  		$postObjectId = null;
  	}
  	
  	$topicObject = $courses->findOne( array("_id" => $topicObjectId) );
  	$postObject = $courses->findOne( array("_id" => $postObjectId) );
  	
  	//Identifier checks
  	if (strcmp($topicObject['identifier'], "topicObject") != 0 ) {
  		$topicObject = null;
  	}
  	if (strcmp($postObject['identifier'], "postObject") != 0) {
  		$postObject = null;
  	}
 
	echo '<div class=\'container\'>
<div class=\'row centered\'>
		<div class="col-md-1"></div> 
		<div class="col-md-8">';
			if (!(is_null($topicObject) || is_null($postObject))){
				//echo '<a href=\'/'.$base.'/topics?'.$topic.'\'><h2>Go back to topic</h2></a>';
				echo '<a href=\'/'.$base.'/topics?'.$topic.'\' class="btn btn-info" id="homebutton" ng-click=\'/'.$base.'/topics?'.$topic.'\' ng-hide=[[buttonShow]] style="font-size:2.5rem;"><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i> Go Back</a>';
			}
			//echo '<a href=\'/'.$base.'/courses\'><h2>Go back home</h2></a>
			echo '<a href="/'.$base.'/courses" class="btn btn-info pull-right" id="backbutton" ng-click=\'/'.$base.'/courses\' ng-hide=[[buttonShow]] style="font-size:2.5rem;"><i class="fa fa-home" aria-hidden="true"></i> Go Home</a>
			<div>';
				if (is_null($topicObject) || is_null($postObject)) {
					echo '<div><h3>No Post Selected</h3></div>';
				}else {

					echo '<h1>'.$postObject['title'].'</h1>';
					if (!empty($postObject['video'])) {
						echo '<div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="'.$postObject['video'].'" frameborder="0" allowfullscreen></iframe></div>';
					}
					$ParseDown = new ParsedownExtra();
					echo $ParseDown->text($gridFS->findOne(array("_id" => $postObject['post']))->getBytes());
				}
			echo '</div>
		</div>
	</div>
</div>';
  }
}
?>