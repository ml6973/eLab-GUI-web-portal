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
  	$pathDir = dirname(__FILE__);  //Initialize the path directory
  	$fullPath = $pathDir . DIRECTORY_SEPARATOR . "../resources/courseData/posts/" . $topic . "/";
  	if (file_exists($fullPath) && is_dir($fullPath) && !preg_match("/^[\\\\\/]+$/", $topic)) {
	  	$files = scandir($fullPath);
	  	$files = array_diff($files, array('.', '..'));
	  	sort($files, SORT_REGULAR | SORT_NATURAL);
  	}else{
  		$topic = null;
  	}
 
	echo '<div class=\'container\'>
<div class=\'row centered\'>
		<div class="col-md-1"></div> 
		<div class="col-md-8">
			<a href=\'/'.$base.'/courses\'><h2>Go back</h2></a>
			<div>';
				if (is_null($topic)) {
					echo '<div><h3>No Topic Selected</h3></div>';
				}else {
					echo '<div>';
					//echo file_get_contents($pathDir . DIRECTORY_SEPARATOR . "../resources/courseData/topics/" . $topic . ".md");
					echo '
							<style>
							ul.mod {
								line-height: 110%;
							}
							</style>
							
							
							<h2>Video Lessons</h2>
							<ul class=\'mod\'>';
								
								foreach($files as $file) {
									if (preg_match('/\.md$/', $file)) {
										$postContents = preg_split('/---/', file_get_contents($fullPath.$file));
										$postAttributes = preg_replace('/:[\s\t]/', ':', $postContents[1]);
										$postAttributes = preg_replace('/[\n\r]+/', "\n", $postAttributes);
										$postAttributes = preg_split('/[:\n\r]/', $postAttributes);
										echo '
										<li>
											<h4>
												<a href="/'.$base.'/posts?'.$topic."&".$file.'"><i class="fa fa-flask" aria-hidden="true"></i> '.$postAttributes[4].'</a>
											</h4>
											<p class=\'text-primary\'>'.$postAttributes[8].'</p>
											<p class=\'text-muted\'> '.$postAttributes[10].'</p>
										</li>';
									}
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