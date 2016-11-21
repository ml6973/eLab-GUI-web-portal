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
  	
  	//Top level of the page. Video player and Q&A will exist here
  	echo '
  			<div class="topLevel">
  				<!-- Embedded Video Player -->
	  			<div class="videoPlayer embed-responsive">
	  				<iframe class="embed-responsive" src="https://www.youtube.com/embed/UGPuEDyAsU8" frameborder="1" allowfullscreen> </iframe>
	  			</div>
  			
  				<!-- Q&A -->
	  			<div class="questionsAnswers">
		  			<span> Q&A </span>
  					<form>
  						<input type="text" name="question" placeholder="Type a question here!">
  						<input type="submit" value="Submit">
  					</form>
  					<br>
  					<blockquote name="reply_answer">
  					</blockquote>
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