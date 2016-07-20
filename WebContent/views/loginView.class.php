<?php  
class LoginView {
	
	public static function show() {
		MasterView::showHeader();
		LoginView::showDetails();
	}
	
	public static function showDetails() {
		$base = $_SESSION['base'];
		$user = (array_key_exists('user', $_SESSION))?
		$_SESSION['user']:null;
		echo 
		'<div>
		<!-- CSS -->
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
		<link rel="stylesheet" href="css/login_form-elements.css">
		<link rel="stylesheet" href="css/login_style.css">

		<div class="top-content">
		 
		<div class="inner-bg">
		<div class="container">
		<div class="row">
		<div class="col-sm-8 col-sm-offset-2 text">
		<h1><strong>eLab</strong> Login Panel</h1>
		<div class="description">
		<p>We offer more valuable courses to registered users.<br>If you have any question, feel free to <a href="/#/about"><strong>contact us</strong></a>!</p>
		</div>
		</div>
		</div>
		<div class="row">
		<div class="col-sm-6 col-sm-offset-3 form-box">
		<div class="form-top">
		<div class="form-top-left">
		<h3>Login to our site</h3>
		<p>Enter your username and password:</p>
		</div>
		<div class="form-top-right">
		<i class="fa fa-lock"></i>
		</div>
		</div>
		<div class="form-bottom">
		<form role="form" action="" method="post" class="login-form">';
		
		if (!is_null($user)) {
			echo '<p><div class="errorBox" id="errorBox"><p>
			<span class="errors" id="loginError">';
			echo '<p>'.$user->getError('userName').'</p>';
			echo '<p>'.$user->getError('password').'</p>';
			echo '</span></p>
			</div></p>';
		}
		echo '<div class="form-group">
		<label class="sr-only" for="form-username">Username</label>
		<input type="text" name="userName" placeholder="Username..." class="form-username form-control" id="userName" ng-model=\'username\' tabindex="1" ';
		if (!is_null($user)) { echo 'value = '.$user->getUserName(); }
		echo ' required>
		</div>
		<div class="form-group">
		<label class="sr-only" for="form-password">Password</label>
		<input type="password" name="password" placeholder="Password..." class="form-password form-control" id="password" ng-model=\'password\' tabindex="2" required>
		</div>';
		echo '<button type="submit" class="btn" ng-click=\'submit()\' tabindex="3">Sign in!</button>
		</form>
		</div>
		</div>
		</div>
		<br><br>
		<div class="row">
		<a name="register" class="btn" color="#4CAF50" href="/'.$base.'/registration">Register!</a>
		</div>
		<div class="row">
		<div class="col-sm-6 col-sm-offset-3 social-login">
		<h3>...or login with:</h3>
		<div class="social-login-buttons">
		<a class="btn btn-link-2" href="/'.$base.'/login">
		<i class="fa fa-facebook"></i> Facebook
		</a>
		<a class="btn btn-link-2" href="/'.$base.'/login">
		<i class="fa fa-twitter"></i> Twitter
		</a>
		<a class="btn btn-link-2" href="/'.$base.'/login">
		<i class="fa fa-google-plus"></i> Google Plus
		</a>
		</div>
		</div>
		</div>
		</div>
		</div>
		</div>
		
		
		<!--	<div class="social-login-buttons">
		<a class="btn btn-link-2" href="/'.$base.'">Home Page</a>
		</div>  -->
		
		</div>';
	}
}
?>