<?php
class vmInfo {
	public static function show() {
		echo '
				<style>
		.well{
		    padding-bottom: 155px;
		    background-color: #c2c2d6;
		}
		</style>
		
		<div class="well">
		  <div class="alert alert-success fade in" id="host_create_tip">
		    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		    <strong>Cloud based eLab are created successfully!</strong> Login and try them.
		  </div>
		
		  <div id=host_login_tip>
		
		    <div class="col-md-4">
		      <div class="bs-callout bs-callout-info" id="how_to_login">
		        <h3><i>How to login to your eLab?</i></h3>
		        <p>
		          Open your terminal, and type:<br>
		          <code>ssh username@hostIP</code>
		          <br>And input the password.  
		        </p>
		      </div>
		    </div>
		
		    <div class="col-md-8">
		      <table class="table table-condensed" id="host_key">
		        <thead>
		          <tr>
		            <th></th>
		            <th>eLab 1</th>
		            <th>eLab 2</th>
		            <th>eLab 3</th>
		          </tr>
		        </thead>
		        <tbody>
		          <tr>
		            <td>IP</td>
		            <td>10.241.1.101</td>
		            <td>10.241.1.102</td>
		            <td>10.241.1.103</td>
		          </tr>
		          <tr>
		            <td>Username</td>
		            <td>elab</td>
		            <td>elab</td>
		            <td>elab</td>
		          </tr>
		          <tr>
		            <td>Password</td>
		            <td>chameleon</td>
		            <td>chameleon</td>
		            <td>chameleon</td>
		          </tr>
		        </tbody>
		      </table>
		    </div>
		
		  </div>
		</div>';
	}
}
?>