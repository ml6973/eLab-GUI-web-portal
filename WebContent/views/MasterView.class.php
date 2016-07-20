<?php
class MasterView {
	public static function showHeader() {
		echo '
		<!DOCTYPE html>
		<html>
		<head>
			<title>Openstack eLab</title>
			<!--Vendor CSS-->
			<link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">
				<!--bootstrap-->
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			
			<link href="css/bootstrap.min.css" rel="stylesheet">
			
			<!--
			<link rel="stylesheet" href="https://bootswatch.com/cerulean/bootstrap.css" media="screen">
		    <link rel="stylesheet" href="https://bootswatch.com/assets/css/custom.min.css">
		    -->
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
				<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
			<link href="http://getbootstrap.com/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
				<!-- Modified local css-->
			<link href="css/jumbotron.css" rel="stylesheet">
				<!-- Font awesome-->
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
		
			<!--Vendor javascripts-->
				<!--AngularJS-->
			<script src="js/angularJS/angular.min.js"></script>
			<script src="js/angularJS/angular-route.js"></script>
			<script src="js/angularJS/angular-route.min.js"></script>
			<script src="js/angularJS/angular-cookie.js"></script>
				<!--Jquery-->
			<script src="http://code.jquery.com/jquery-latest.js"></script>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
			<script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>
		    	<!--bootstrap-->
		    		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
			<script src="http://getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>
			
		
		</head>';
    }
    
    public static function showNavBar() {
    	// Show the navbar
    	$base = (array_key_exists('base', $_SESSION))? $_SESSION['base']: "";
    	$authenticatedUser = (array_key_exists('authenticatedUser', $_SESSION))?
    	$_SESSION['authenticatedUser']:null;
    	$authenticatedUserData = (array_key_exists('authenticatedUserData', $_SESSION))?
    	$_SESSION['authenticatedUserData']:null;
    	$user = (array_key_exists('user', $_SESSION))?$_SESSION['user']:null;
    	echo '
    	<!--Navigation bar-->
    	<style>
    	#webname {
    	font-size: 25px;
    	font-family: museo-slab, Georgia, "Times New Roman", Times, serif;
    	font-weight: 300;
    	}
    	#login-btn {
    	font-size: 20px;
    	}
    	#logout-btn {
    	font-size: 20px;
    	}
    	</style>
    	
    	<div ng-controller=\'headController\'>
    	<nav class="navbar navbar-inverse navbar-fixed-top">
    	<div class="container">
    	<div class="navbar-header">
    	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
    	<span class="sr-only">Toggle navigation</span>
    	<span class="icon-bar"></span>
    	<span class="icon-bar"></span>
    	<span class="icon-bar"></span>
    	</button>
    	<a id="webname" class="navbar-brand" href="/#/"> <i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>pen Cloud eLab</a>
    	</div>
    	<div id="navbar" class="navbar-collapse collapse">
    	<ul id="login" class="nav navbar-nav navbar-right">
    	
    	<!-- <li><a href="" id="login-btn" ng-click=\'Login()\' ng-show=[[buttonShow]]><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a></li> -->
    	<li><a href="/'.$base.'/logout" id="logout-btn" ng-click=\'/'.$base.'/logout\' ng-hide=[[buttonShow]]>Logout <i class="fa fa-sign-out" aria-hidden="true"></i></a></li>li>
    	<!--
    	<button id="login-btn" class="btn btn-info" ng-click=\'Login()\' ng-show=[[buttonShow]]>Login</button>
    	<button id="logout-btn" class="btn btn-info" ng-click=\'Logout()\' ng-hide=[[buttonShow]]>Logout</button>
    	-->
    	
    	</ul>
    	</div><!--/.navbar-collapse -->
    	</div>
    	</nav>
    	</div>';
    }
    	
   	public static function showFooter() {
   		echo '<link rel="stylesheet" href="css/foot_style.css">
			<footer id=\'foot\' class=\'footer-distributed\'>
			    <div class="container">
			        <div class="row">
			            <div class="footer-left">
			                <div>
			                <h5>GitHub</h5>
			                <ul class=\'list-unstyled\'>   
			                    <li><a href="https://github.com/cloudandbigdatalab/cloudandbigdatalab.github.io">About us</a></li>
			                    <li><a href="#/about">Technical Support</a></li>
			                </ul>
			                </div>
			            </div>
			            <div class="footer-center">
			                <div>
			                <h5>Courses</h5>
			                <ul class=\'list-unstyled\'>
			                    <li><a href="#/topics/openstack_contribution">Openstack Contribution</a></li>
			                    <li><a href="#/topics/openstack_installation">Openstack Installation</a></li>
			                    <li><a href="#/topics/cloud_dashboard">Cloud Dashboard</a></li>
			                    <li><a href="#/topics/ceph_installation">CEPH</a></li>
			                    <li><a href="#/topics/swift_installation">Swift</a></li>
			                    <li><a href="#/topics/docker_containers">Docker Containers</a></li>
			                    <li><a href="#/topics/Kubernetes">Orchestration of Containers</a></li>
			                    <li><a href="#/topics/machine_learning">Machine Learning</a></li>
			                    <li><a href="#/topics/tensor_flow">Tensor Flow for Machine Learning</a></li>
			                    <li><a href="#/topics/caffe_for_deep_learning">Caffe for Deep Learning</a></li>
			                    <li><a href="#/topics/internet_of_things">Internet of Things</a></li>
			                </ul>
			                </div>
			            </div>
			            <div class="footer-right">
			                <div>
			                <h5>Service</h5>
			                <ul class=\'list-unstyled\'> 
			                    <li><a href="#/">Instructor</a></li>
			                    <li><a href="#/">Students</a></li>
			                    <li><a href="#/">Admin</a></li>
			                </ul>
			                </div>
			            </div>
			        </div>
			
			
			        <div class="row">
			            <div class="footer-bottom-left">
			                <div>
			                <p class="footer-company-name text-muted">2016 © Openstack eLab. All rights reserved. <br>Site built by Xin Zhang.</p>
			                </div>
			            </div>
			
			        </div>
			
			    </div>
			</footer>';
   	}
}
?>