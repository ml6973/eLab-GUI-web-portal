<?php
// Responsibility: maintains open mongoDB connection
class MongoDatabase {
    private static $connection;
    private static $connectionString;
    private static $authDBName;
    private static $dbHost;
    private static $dbPort;
    private static $username;
    private static $password;
    private static $courseDBName;
    private static $passArray;
	
	public static function getConnection($courseDBName = 'oci_eLab_courses', $configPath = null) {
		
		if (!isset (self::$connection) || self::$connection == null) {
			try {
				if ($configPath == null)
			   	    $configPath = dirname(__FILE__).DIRECTORY_SEPARATOR."..". 
				             DIRECTORY_SEPARATOR. ".." . DIRECTORY_SEPARATOR.
					           ".." . DIRECTORY_SEPARATOR . "myConfig.ini";
				$passArray = parse_ini_file($configPath);
				$username = $passArray["mongoUsername"];
				$password = $passArray["mongoPassword"];
				self::$authDBName = $passArray["mongoAuthDatabase"];
				self::$courseDBName = $courseDBName;
				self::$dbHost = $passArray["mongoIp"];
				self::$dbPort = $passArray["mongoPort"];
				self::$connectionString = sprintf('mongodb://%s:%d/%s', self::$dbHost, self::$dbPort, self::$authDBName);
				self::$connection = new Mongo(self::$connectionString,array('username'=>$username,'password'=>$password));
				self::$courseDBName = self::$connection->selectDB(self::$courseDBName);
			} catch ( MongoException $e ) {
				self::$connection = null;
				echo "Failed to open connection to ".self::$courseDBName. $e->getMessage();
			}
		}
		return self::$connection;
	}
	
	public static function clearDB() {
		self::$connection = null;
	}
}
?>