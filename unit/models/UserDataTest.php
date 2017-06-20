<?php
require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'WebContent'.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR.'Messages.class.php';
require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'WebContent'.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR.'UserData.class.php';

class UserDataTest extends PHPUnit_Framework_TestCase {
	
  public function testValidUserDataCreate() {
  	$validTest = array("email" => "test@gdail.com",
				   "vmPassword" => "testpassword",
				   "messengerId" => "1234567890"
	);
  	$s1 = new UserData($validTest);
    $this->assertTrue(is_a($s1, 'UserData'), 
    	'It should create a valid UserData object when valid input is provided');
    
  }
  
  public function testInvalidEmail() {
  	$invalidTest = array("email" => "test@",
				     "vmPassword" => "testpassword",
				     "messengerId" => "1234567890"
	);
  	$s1 = new UserData($invalidTest);
  	$this->assertGreaterThan(0, $s1->getErrorCount(),
  			'It should have an error if the email is invalid');
  }
  
  public function testBlankVMPassword() {
  	$invalidTest = array("email" => "test@gdail.com",
  			         "vmPassword" => "",
  			         "messengerId" => "1234567890"
  	);
  	$s1 = new UserData($invalidTest);
  	$this->assertGreaterThan(0, $s1->getErrorCount(),
  			'It should have an error if the vm password is blank');
  }

}
?>