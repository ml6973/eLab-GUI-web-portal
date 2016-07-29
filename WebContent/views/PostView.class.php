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
					$postContents = preg_split('/---[\r\n]/', file_get_contents($fullPath.$post), 3);
					$postAttributes = preg_replace('/:[\s\t]/', ':', $postContents[1]);
					$postAttributes = preg_replace('/[\n\r]+/', "\n", $postAttributes);
					$postAttributes = preg_split('/[:\n\r]/', $postAttributes);
					$fileName = $pathDir . DIRECTORY_SEPARATOR . "../resources/courseData/videos/videos.yaml";
					$yaml = Spyc::YAMLLoad($fileName);
					if (empty($postAttributes[0]))
						$number = 4;
					else
						$number = 3;
					echo '<h1>'.$postAttributes[$number].'</h1>';
					foreach($yaml as $topic) {
						if (strcmp($topic['title'], $postAttributes[$number]) == 0)
							echo $topic['code'];
					}
					$ParseDown = new ParsedownExtra();
					echo $ParseDown->text($postContents[2]);
				}
			echo '</div>
		</div>
	</div>
</div>';
  }
}
?>