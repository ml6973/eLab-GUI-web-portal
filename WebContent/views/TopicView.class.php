<?php
class TopicView {
  public static function show($topic) { 
	  MasterView::showHeader();
	  MasterView::showNavBar();
	  TopicView::showDetails($topic);
	  MasterView::showFooter();
  }

  public static function showDetails($topic) {
  	$base = $_SESSION['base'];
  	
  	//Get connection and select the collection
  	$db = MongoDatabase::getConnection();
  	$courses = $db->selectCollection('courseData');
  	$gridFS = $db->getGridFS();
  	
	//Build Object ID from parameter
	$object = null;
	try {
	  $object = new MongoId($topic);
	} catch (MongoException $e) {
	  $object = null;
	}
  	$topicObject = $courses->findOne( array("_id" => $object) );
  	
	echo '<div class=\'container\'>
<div class=\'row centered\'>
		<div class="col-md-1"></div> 
		<div class="col-md-8">
			<!-- <a href=\'/'.$base.'/courses\'><h2>Go back</h2></a> -->
			<a href="/'.$base.'/courses" class="btn btn-info" id="backbutton" ng-click=\'/'.$base.'/courses\' ng-hide=[[buttonShow]] style="font-size:2.5rem;"><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i> Go Back</a>
			<div>';
				if (is_null($topicObject) || is_null($object) || strcmp($topicObject['identifier'], "topicObject") != 0) {
					echo '<div><h3>No Topic Selected</h3></div>';
				}else {
					echo '<div>';
					echo '
							<style>
							ul.mod {
								line-height: 110%;
							}
							</style>
							
							
							<!-- <h2>Video Lessons</h2> -->
							<h2>'.$topicObject['title'].'</h2>
							<ul class=\'mod\'>';
								
								foreach($topicObject['posts'] as $post) {
									$postObject = $courses->findOne( array('_id' => $post) );
									echo '
									<li>';
									if (array_key_exists("layout", $postObject) && (strcmp($postObject['layout'],"post") == 0)) {
										echo '<h4>
											<a href="/'.$base.'/posts?'.$topicObject['_id']."&".$postObject['_id'].'"><i class="fa fa-flask" aria-hidden="true"></i> '.$postObject['title'].'</a>
										</h4>';
									} else {
										echo '<h4>
											<i class="fa fa-flask" aria-hidden="true"></i> '.$postObject['title'].'
										</h4>';
									}
										echo '<p class=\'text-primary\'>'.$postObject['author'].'</p>
										<p class=\'text-muted\'> '.$postObject['description'].'</p>
									</li>';
								}
							echo '
							</ul>';
					echo '</div>';
				}
			echo '</div>
		</div>
	</div>
</div>';
  }
}
?>