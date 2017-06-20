<?php
require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'WebContent'.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR.'Messages.class.php';
require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'WebContent'.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR.'User.class.php';

class UserTest extends PHPUnit_Framework_TestCase {
	
  public function testValidUserCreate() {
  	$validTest = array("userName" => "ghooks", "password" => "123");
  	$s1 = new User($validTest);
    $this->assertTrue(is_a($s1, 'User'), 
    	'It should create a valid User object when valid input is provided');
    
  }
  
  public function testInvalidUserName() {
  	$invalidTest = array("userName" => "ghooks$", "password" => "123");
  	$s1 = new User($invalidTest);
  	$this->assertGreaterThan(0, $s1->getErrorCount(),
  			'It should have an error if the user name is invalid');
  }

}
?>