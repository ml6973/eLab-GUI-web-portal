<?php

class DBMaker {
	public static function create($dbName) {
		// Creates a database named $dbName for testing and returns connection
		$db = null;
		// Creates a database named $dbName for testing and returns connection
		try {
			$dbspec = 'mysql:host=localhost;charset=utf8';
			$configPath = null;
			if ($configPath == null)
				$configPath = dirname(__FILE__).DIRECTORY_SEPARATOR."..".
				DIRECTORY_SEPARATOR. ".." . DIRECTORY_SEPARATOR.
				".." . DIRECTORY_SEPARATOR . "myConfig.ini";
			$passArray = parse_ini_file($configPath);
			$username = $passArray["username"];
			$password = $passArray["password"];
		    $options = array (PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
	        $db = new PDO ($dbspec, $username, $password, $options);
			$st = $db->prepare("DROP DATABASE IF EXISTS $dbName");
			$st->execute();
			$st = $db->prepare("CREATE DATABASE $dbName");
			$st->execute();
			$st = $db->prepare("USE $dbName");
			$st->execute();
			$st = $db->prepare(
				"CREATE TABLE Users (
						userId             int(11) NOT NULL AUTO_INCREMENT,
						facebookId		   varchar (255) UNIQUE COLLATE utf8_unicode_ci,
						userName           varchar (255) UNIQUE NOT NULL COLLATE utf8_unicode_ci,
						passwordHash           varchar(255) COLLATE utf8_unicode_ci,
					    dateCreated    TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
						PRIMARY KEY (userId)
				)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci"
			);
			$st->execute();
			
			$st = $db->prepare ("CREATE TABLE UserData (
								  userId             int(11) NOT NULL COLLATE utf8_unicode_ci,
								  email           	 varchar(255) COLLATE utf8_unicode_ci,
								  vmPassword         varchar(255) COLLATE utf8_unicode_ci,
								  messengerId		 varchar(255) COLLATE utf8_unicode_ci,
								  FOREIGN KEY (userId) REFERENCES Users(userId)
								)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;"
			);
			$st->execute ();
			
			$st = $db->prepare ("CREATE TABLE Registration (
								  userId             int(11) NOT NULL COLLATE utf8_unicode_ci,
								  complete			 boolean DEFAULT false,
								  FOREIGN KEY (userId) REFERENCES Users(userId)
								)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;"
					);
			$st->execute ();
			
			$sql = "INSERT INTO Users (userId, facebookId, userName, passwordHash) VALUES
			                          (:userId, :facebookId, :userName, :passwordHash)";
			$st = $db->prepare($sql);
			$st->execute(array(':userId' => 1, 'facebookId' => '123', ':userName' => 'May', ':passwordHash' => 'xxx'));
		    $st->execute(array(':userId' => 2, 'facebookId' => '1234', ':userName' => 'John', ':passwordHash' => 'yyy'));
		    $st->execute(array(':userId' => 3, 'facebookId' => '1235', ':userName' => 'Alice', ':passwordHash' => 'zzz'));
		    $st->execute(array(':userId' => 4, 'facebookId' => '1236', ':userName' => 'George', ':passwordHash' => 'www'));
		    
		    $sql = "INSERT INTO UserData (userId, email, vmPassword, messengerId) VALUES
			                          (:userId, :email, :vmPassword, :messengerId)";
		    $st = $db->prepare($sql);
		    $st->execute(array(':userId' => 1, ':email' => 'May@gdail.com', ':vmPassword' => 'xxxx', 'messengerId' => '12345'));
		    $st->execute(array(':userId' => 2, ':email' => 'John@gdail.com', ':vmPassword' => 'yyyy', 'messengerId' => '123456'));
		    $st->execute(array(':userId' => 3, ':email' => 'Alice@gdail.com', ':vmPassword' => 'zzzz', 'messengerId' => '1234567'));
		    $st->execute(array(':userId' => 4, ':email' => 'George@gdail.com', ':vmPassword' => 'wwww', 'messengerId' => '12345678'));
		
		    $sql = "INSERT INTO Registration (userId) VALUES
			                          (:userId)";
		    $st = $db->prepare($sql);
		    $st->execute(array(':userId' => 1));
		    $st->execute(array(':userId' => 2));
		    $st->execute(array(':userId' => 3));
		    
		    $sql = "INSERT INTO Registration (userId, complete) VALUES
			                          (:userId, :complete)";
		    $st = $db->prepare($sql);
		    $st->execute(array(':userId' => 4, ':complete' => true));
		    
		} catch ( PDOException $e ) {
			echo $e->getMessage ();  // not final error handling
		}
		
		return $db;
	}
	public static function delete($dbName) {
		// Delete a database named $dbName
		try {
			$dbspec = 'mysql:host=localhost;dbname=' . $dbName . ";charset=utf8";
			$configPath = null;
                        if ($configPath == null)
                                $configPath = dirname(__FILE__).DIRECTORY_SEPARATOR."..".
                                DIRECTORY_SEPARATOR. ".." . DIRECTORY_SEPARATOR.
                                ".." . DIRECTORY_SEPARATOR . "myConfig.ini";
                        $passArray = parse_ini_file($configPath);
                        $username = $passArray["username"];
                        $password = $passArray["password"];
			$options = array (PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
			$db = new PDO ($dbspec, $username, $password, $options);
			$st = $db->prepare ("DROP DATABASE if EXISTS $dbName");
			$st->execute ();
		} catch ( PDOException $e ) {
			echo $e->getMessage (); // not final error handling
		}
	}
}
?>