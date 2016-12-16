<?php
class MarketPlaceView {
  public static function show() {
	  MasterView::showHeader();
	  MasterView::showNavBar();
	  MarketPlaceView::showDetails();
      MarketPlaceView::showFooter();
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
	       <div class="title" id="welcome">Welcome to Open A.I. Cloud Marketplace!</div>
           <div class="slogan">Hands-on learning powered by personal environments.</div>
	       <!--	<p>Everyone knows about the giant skills gap that is haunting the IT sector worldwide. Powered by Chameleon Cloud, eLab cloud based learning platform helps you achieve certification for today\'s tech job.</p> -->
	       <!--	<p><a class="btn btn-primary btn-md" href="/#/about" role="button">Learn more &raquo;</a></p> -->
	    </div>
	</div>';

	echo '

  	<div class="container">
  		<div class="row">';
	$db = MongoDatabase::getConnection();
	$courses = $db->selectCollection('courseData');
	$gridFS = $db->getGridFS();
	$results = iterator_to_array($courses->find( array("identifier" => "marketPlaceObject") ));
	$results = array_merge($results, iterator_to_array($courses->find( array("identifier" => "applicationObject") )));
	
	foreach($results as $course) {
		echo '
  			<div class="col-sm-6 col-md-4 col-lg-3">
				<div class="thumbnail">
					<a href="course_details?'.$course['_id'].'" class="">
						<img src="data:image/jpg;base64,'.base64_encode($gridFS->findOne(array("_id" => $course['thumbnail']))->getBytes()).'" alt="Thumbnail">
						<div class="partner"><span>'.$course['organization'].'</span></div>
						<div class="coursetitle">'.$course['mtitle'].'</div>';
		                if (strcmp($course['contentType'], "course") == 0) {
							if (strcmp($course['lessoncount'], "1") == 0) {
							   echo '<div class="footer"><span>1 Lesson</span></div>';
							}else {
								echo '<div class="footer"><span>'.$course['lessoncount'].' Lessons</span></div>';
							}
		                }
			echo		'</a>
					 </div>
				</div>';
	}

	echo '<!-- <div class="col-sm-6 col-md-4 col-lg-3">
					<div class="thumbnail">
						<img src="/'.$base.'/resources/marketPlaceData/coming_soon/thumbnail.jpg" alt="Thumbnail">
						<div class="partner"><span>The University of Texas at San Antonio</span></div>
						<div class="coursetitle">Cyber Security</div>
						<div class="footer"><span>Coming Soon...</span></div>
					 </div>
		  </div> -->';

  	echo '</div>
  	</div>

	';
  }

    public static function showFooter() {
        //Get the base path of this session's webcontent location
    	$base = $_SESSION['base'];
    	//init the path directory
    	$pathDir = dirname(__FILE__);
    	$fullPath = $pathDir.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."resources".DIRECTORY_SEPARATOR."organizations".DIRECTORY_SEPARATOR."sponsors".DIRECTORY_SEPARATOR;
    	if (file_exists($fullPath) && is_dir($fullPath)) {
    		$files = scandir($fullPath);
    		$files = array_diff($files, array('.', '..'));
    	}
      	echo '
      	<link rel="stylesheet" href="css/marketplace.css">
    	<div class="footer-center">
            <div class="row" style ="text-align: center;">
            	<div class = "footer-company-name">
                    <h3>
                    	Powered by:
                    	<img style="padding-left: .5em;" height="75px" src="'.DIRECTORY_SEPARATOR.$base.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'organizations'.DIRECTORY_SEPARATOR.'chameleonclo.png" alt="Chameleon Cloud">
                    </h3>
                </div>';

        		echo '
        		<div class = "footer-sponsors">';
        		foreach($files as $file) {
        			echo '
        			<img src="'.DIRECTORY_SEPARATOR.$base.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'organizations'.DIRECTORY_SEPARATOR.'sponsors'.DIRECTORY_SEPARATOR.$file.'">
        			';
        		}
                echo '
    		    </div>
            </div>';
    	echo '
    	</div>';
    }
}
?>
