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
  	$pathDir = dirname(__FILE__);  //Initialize the path directory
  	/*echo '
	---
	layout: default
	title: Openstack eLab
	--- ';*/
	echo '
	<script src="js/getVMIP.js"></script>
	<!--Banner-->
	<div class="jumbotron">
	   	<div class="container">
	       	<h1 id="welcome">Welcome to Open Cloud eLab!</h1>
	       	<p>Everyone knows about the giant skills gap that is haunting the IT sector worldwide. Powered by Chameleon Cloud, eLab cloud based learning platform helps you achieve certification for today\'s tech job.</p>
	       <!--	<p><a class="btn btn-primary btn-md" href="/#/about" role="button">Learn more &raquo;</a></p> -->
	    </div>
	</div>
	<div class="container">
		<h2 class="text-left">Openstack Developer Certification:</h2>
	  <p>This course is an introduction class covering the core OpenStack projects including Nova, Neutron, Glance, Keystone and Horizon. This course covers lessons that range from community code contribution, understanding the architecture, to installing and configuring. This course is a great primer for anyone interested in OpenStack code development. This course is designed for technical individuals and consists of hands on labs.</p>
		<br>
		<div class="col-md-8">';
			$fileName = $pathDir . DIRECTORY_SEPARATOR . "../resources/courseData/topics/topics.yml";
			$yaml = Spyc::YAMLLoad($fileName);
			foreach($yaml as $topic) {
				echo '
	           <ul>
		        	<div>
			    		<a href="topics?'.$topic["link"].'" >  <h3> - '.$topic["title"].'</h3></a>
			    		<!--description
	            <p>'.$topic["description"].'</p>
	            -->
			    	</div>
	          </ul>';
			}
			echo '
	    	<br><br>
		</div>
		<div class="col-md-2" ng-include>';
			vmInfo::show("Image1");
		echo '</div>
	</div>
	<div class="container">
	  <h2 class="text-left"> Software Defined Storage</h2>
	  <p>Software-defined storage (SDS) is an evolving concept for computer data storage software to manage policy-based provisioning and management of data storage independent of the underlying hardware. This course is all about implementation of object and block storage using Software Defined Storage platforms</p>
	  <br>
	  <div class="col-md-8">';
			$fileName = $pathDir . DIRECTORY_SEPARATOR . "../resources/courseData/topics/objstorage.yaml";
			$yaml = Spyc::YAMLLoad($fileName);
			foreach($yaml as $topic) {
				echo '
	           <ul>
		        	<div>
			    		<a href="topics?'.$topic["link"].'" >  <h3> - '.$topic["title"].'</h3></a>
			    		<!--description
	            <p>'.$topic["description"].'</p>
	            -->
			    	</div>
	          </ul>';
			}
			echo '
	    	<br><br>
		</div>
		<div class="col-md-2" ng-include>';
			vmInfo::show("Image2");
		echo '
	    </div>
	</div>
	
	<div class="container">
	  <h2 class="text-left"> Docker Containers Certification</h2>
	  <p>Docker has brought a revolution in containerization technology. With evolving shift in Cloud computing towards containerization, more popularly Docker Containerization,  our tutorials are aimed at helping enthusiasts understand basic and important features of Docker containers. The videos and manuals together provide practical as well as theoretical knowledge for people from various levels of understanding starting from Beginner – Need to know all, to Users – Wanting to know more.</p>
	  <br>
	  <div class="col-md-8">';
			$fileName = $pathDir . DIRECTORY_SEPARATOR . "../resources/courseData/topics/docker.yaml";
			$yaml = Spyc::YAMLLoad($fileName);
			foreach($yaml as $topic) {
				echo '
	           <ul>
		        	<div>
			    		<a href="topics?'.$topic["link"].'" >  <h3> - '.$topic["title"].'</h3></a>
			    		<!--description
	            <p>'.$topic["description"].'</p>
	            -->
			    	</div>
	          </ul>';
			}
			echo '
	    	<br><br>
		</div>
		<div class="col-md-2" ng-include>';
			vmInfo::show("Image3");
		echo '
	    </div>
	</div>
	
	<div class="container">
	  <h2 class="text-left">Machine Learning Certification</h2>
	  <p>Neural Network is inspired from our biological neural system. High end technologies these days, do not require human intervention for its functioning. Humans key in the algorithm to make it predict results, automate the decision making process and thereby promoting smart moves on the classification / recognition problem at hand. The following sections of tutorials are potential sources of information providing the key concepts of machine learning, catering to users of all levels.</p>
	  <br>
	  <div class="col-md-8">';
			$fileName = $pathDir . DIRECTORY_SEPARATOR . "../resources/courseData/topics/topics3.yaml";
			$yaml = Spyc::YAMLLoad($fileName);
			foreach($yaml as $topic) {
				echo '
	           <ul>
		        	<div>
			    		<a href="topics?'.$topic["link"].'" >  <h3> - '.$topic["title"].'</h3></a>
			    		<!--description
	            <p>'.$topic["description"].'</p>
	            -->
			    	</div>
	          </ul>';
			}
			echo '
	    	<br><br>
		</div>
		<div class="col-md-2" ng-include>';
			vmInfo::show("Image4");
		echo '
	    </div>
	</div>
	
	<div class="container">
	  <h2 class="text-left">Internet of Things Certification (Coming soon):</h2>
	  <p>This guide provides detailed instructions on the documentation contribution workflow and conventions to be considered by all contributors. Please follow these guidelines to keep the documentation structure, style, and syntax consistent.</p>
	  <br>
	  <div class="col-md-8">';
			$fileName = $pathDir . DIRECTORY_SEPARATOR . "../resources/courseData/topics/topics4.yml";
			$yaml = Spyc::YAMLLoad($fileName);
			foreach($yaml as $topic) {
				echo '
	           <ul>
		        	<div>
			    		<!--<a href="topics?'.$topic["link"].'" >-->  <h3> - '.$topic["title"].'</h3></a>
			    		<!--description
	            <p>'.$topic["description"].'</p>
	            -->
			    	</div>
	          </ul>';
			}
			echo '
	    	<br><br>
		</div>
		<div class="col-md-2" ng-include>';
			//vmInfo::show("Image5");
		echo '
	    </div>
	</div>';
  }
}
?>