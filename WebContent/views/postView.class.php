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
  	$pathDir = dirname(__FILE__);  //Initialize the path directory
  	$fullPath = $pathDir . DIRECTORY_SEPARATOR . "../resources/courseData/posts/" . $topic . "/";
  	if (!(file_exists($fullPath) && file_exists($fullPath.$post)) || empty($post) || !is_file($fullPath.$post)) {
  		$topic = null;
  		$post = null;
  	}
 
	echo '<div class=\'container\'>
<div class=\'row centered\'>
		<div class="col-md-1"></div> 
		<div class="col-md-8">';
			if (!(is_null($topic) || is_null($post)))
				echo '<a href=\'/'.$base.'/topics?'.$topic.'\'><h2>Go back to topic</h2></a>';
			echo '<a href=\'/'.$base.'/courses\'><h2>Go back home</h2></a>
			<div>';
				if (is_null($topic) || is_null($post)) {
					echo '<div><h3>No Post Selected</h3></div>';
				}else {
					$postContents = preg_split('/---/', file_get_contents($fullPath.$post));
					$ParseDown = new Parsedown();
					echo $ParseDown->text($postContents[2]);
				}
			echo '</div>
		</div>
	</div>
</div>';
  }
}
?>