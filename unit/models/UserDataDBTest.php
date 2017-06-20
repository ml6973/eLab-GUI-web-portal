<?php
require_once dirname(__FILE__).'\..\..\WebContent\models\Database.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\Messages.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\User.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\UsersDB.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\UserData.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\UserDataDB.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\tests\makeDB.php';


class UserDataDBTest extends PHPUnit_Framework_TestCase {
	
  public function testGetAllUserData() {
  	  $myDb = DBMaker::create ('ptest');
  	  Database::clearDB();
  	  $db = Database::getDB('ptest', 'C:\xampp\myConfig.ini');
  	  $userData = UserDataDB::getUserDataBy();
  	  $this->assertEquals(4, count($userData), 
  	  		'It should fetch all of the user data in the test database');

  	  foreach ($userData as $user) 
          $this->assertTrue(is_a($user, 'UserData'), 
        		'It should return valid UserData objects');
  }
  
  public function testInsertValidUserData() {
  	$myDb = DBMaker::create ('ptest');
  	Database::clearDB();
  	$db = Database::getDB('ptest', 'C:\xampp\myConfig.ini');
  	$beforeCount = count(UserDataDB::getUserDataBy());
  	$validTest = array("userName" => "blahuser", "password" => "123");
	$user = new User($validTest);
	$validTest = array("email" => "test@gdail.com", "vmPassword" => "testPassword", "messengerId" => "1234567890");
	$userdata = new UserData($validTest);
	$userId = UsersDB::addUser($user);
	$user->setUserId($userId);
	UserDataDB::addUserData($user, $userdata);
  	$afterCount = count(UsersDB::getUsersBy());
  	$this->assertEquals($afterCount, $beforeCount + 1,
  			'The database should have one more user data after insertion');
  }
  
  public function testInsertInvalidUserData() {
  	ob_start();
  	$myDb = DBMaker::create ('ptest');
  	Database::clearDB();
  	$db = Database::getDB('ptest', 'C:\xampp\myConfig.ini');
  	$beforeCount = count(UsersDB::getUsersBy());
  	$validTest = array("userName" => "blahuser", "password" => "123");
  	$user = new User($validTest);
	$invalidUserData = new UserData(array("email" => "test", "vmPassword" => "goodPassword", "messengerId" => "garbage"));
	$userId = UserDataDB::addUserData($user, $invalidUserData);
  	$afterCount = count(UserDataDB::getUserDataBy());
  	$this->assertEquals($afterCount, $beforeCount,
  			'The database should have the same number of elements after trying to insert duplicate');
  	ob_get_clean();
  }
}
?>