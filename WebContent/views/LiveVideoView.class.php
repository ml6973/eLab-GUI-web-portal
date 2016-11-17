<?php
class LiveVideoView {
  public static function show() {
	  MasterView::showHeader();
	  MasterView::showNavBar();
	  LiveVideoView::showDetails();
	  MasterView::showFooter();
  }

  public static function showDetails() {
  	$base = $_SESSION['base'];
  	$pathDir = dirname(__FILE__);  //Initialize the path directory
  	
  	echo '
  			<head>
  			<!-- CSS -->
  			<link rel="stylesheet" href="css/live_video_style.css">
  			</head>
  			
  			<!-- Page Title -->
  			<div class="pageTitle"><h1> ShowCase </h1></div>
  			';
  	
  	//Top level of the page. Video player and Q&A (or whatever chat feature) will exist here
  	/*
  	echo '
  			<div class="topLevel">
	  			<!-- Embedded Video Player -->
	  			<div class="videoPlayer">
	  				<iframe src="https://www.youtube.com/embed/UGPuEDyAsU8" style="margin-right: 5px;" width="65%" height="400px" frameborder="1" allowfullscreen> </iframe>
	  			
	  				<!-- Q&A -->
	  				<div class="questions_answers">
	  					<iframe src="https://www.youtube.com/live_chat?v=UGPuEDyAsU8" frameborder="1" width="100%" height="400px" allowfullscreen> </iframe>
	  				</div>
  				</div>
  			</div>
  			';
  	*/
  	echo '
  			<div class="topLevel">
	  			<div class="videoPlayer embed-responsive">
	  				<iframe class="embed-responsive" src="https://www.youtube.com/embed/UGPuEDyAsU8" frameborder="1" allowfullscreen> </iframe>
	  			</div>
	  			<div class="questions_answers">
		  			<iframe src="https://www.youtube.com/live_chat?v=UGPuEDyAsU8" frameborder="1" allowfullscreen> </iframe>
		  		</div>
  			</div>
  			';
  	
  	//Second level of the page. Previous Videos and Upcoming will exist here
  	echo '
  			<div class="secondLevel">
  				<!-- Previous Videos -->
  				<div class="previousVideos">
  					<span> Previous Videos </span>
  				</div>
  			
  				<!-- Upcoming Events -->
  				<div class="upcomingEvents">
  					<span> Upcoming Events </span>
  					<br>
  					<span> First event 7/22/2017 </span>
  				</div>
  			</div>
  			';
  }
}
?>