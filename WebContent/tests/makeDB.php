<?php
function makeDB($dbName) {
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
							  FOREIGN KEY (userId) REFERENCES Users(userId)
							)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;"
		);
		$st->execute ();
		
		$sql = "INSERT INTO Users (userId, userName, passwordHash) VALUES
		                          (:userId, :userName, :passwordHash)";
		$st = $db->prepare($sql);
		$st->execute(array(':userId' => 1, ':userName' => 'May', ':passwordHash' => 'xxx'));
	    $st->execute(array(':userId' => 2, ':userName' => 'John', ':passwordHash' => 'yyy'));
	    $st->execute(array(':userId' => 3, ':userName' => 'Alice', ':passwordHash' => 'zzz'));
	    $st->execute(array(':userId' => 4, ':userName' => 'George', ':passwordHash' => 'www'));
	    
	    $sql = "INSERT INTO UserData (userId, email, vmPassword) VALUES
		                          (:userId, :email, :vmPassword)";
	    $st = $db->prepare($sql);
	    $st->execute(array(':userId' => 1, ':email' => 'May@gdail.com', ':vmPassword' => 'xxxx'));
	    $st->execute(array(':userId' => 2, ':email' => 'John@gdail.com', ':vmPassword' => 'yyyy'));
	    $st->execute(array(':userId' => 3, ':email' => 'Alice@gdail.com', ':vmPassword' => 'zzzz'));
	    $st->execute(array(':userId' => 4, ':email' => 'George@gdail.com', ':vmPassword' => 'wwww'));
	
	} catch ( PDOException $e ) {
		echo $e->getMessage ();  // not final error handling
	}
	
	return $db;
}
?>