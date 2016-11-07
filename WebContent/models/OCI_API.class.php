<?php
class OCI_API {
	
	private static $apiIp;
	private static $apiPass;
	private static $apiUser;
	
	public static function getCatalog() {
		$configFile = self::getConfig();
		self::$apiIp = $configFile["api_Ip"];
		
		$ch = curl_init();
		
		curl_setopt($ch, CURLOPT_URL, "http://".self::$apiIp."/catalog/");
		curl_setopt($ch, CURLOPT_HEADER, 0);
		
		$response = curl_exec($ch);
		
		curl_close($ch);
		
		return($response);
	}
	
	public static function getInstances($userID) {
		$configFile = self::getConfig();
		self::$apiIp = $configFile["api_Ip"];
		self::$apiUser = $configFile["api_User"];
		self::$apiPass = $configFile["api_Pass"];
		
		
		$json = array("api_uname" => self::$apiUser, 
						"api_pass" => self::$apiPass, 
						"userid" => $userID);
		$json = json_encode($json);
		
		$ch = curl_init();
	
		curl_setopt($ch, CURLOPT_URL, "http://".self::$apiIp."/lablist/");
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    		'Content-Type: application/json',
    		'Content-Length: ' . strlen($json))
		);
	
		$response = curl_exec($ch);
	
		curl_close($ch);
		
		$response = json_decode($response, true);
	
		return($response);
	}
	
	public static function getInstanceIPByImageName($userID, $imageName) {
		$configFile = self::getConfig();
		self::$apiIp = $configFile["api_Ip"];
		self::$apiUser = $configFile["api_User"];
		self::$apiPass = $configFile["api_Pass"];
		
		$json = array("api_uname" => self::$apiUser,
				"api_pass" => self::$apiPass,
				"userid" => $userID);
		$json = json_encode($json);
	
		$ch = curl_init();
	
		curl_setopt($ch, CURLOPT_URL, "http://".self::$apiIp."/lablist/");
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Content-Type: application/json',
				'Content-Length: ' . strlen($json))
				);
	
		$response = curl_exec($ch);
	
		curl_close($ch);
		
		$response = json_decode($response, true);
		
		if (is_null($response))
			return null;
		
		$instance = (array_key_exists($imageName, $response))?
		$response[$imageName]:null;
		
		if (is_null($instance))
			return null;
	
		$instance = explode("-", $instance)[0];
		$instance = trim($instance);
		
		return($instance);
	}
	
	protected static function getConfig() {
		$configPath = dirname(__FILE__).DIRECTORY_SEPARATOR."..".
		DIRECTORY_SEPARATOR. ".." . DIRECTORY_SEPARATOR.
		".." . DIRECTORY_SEPARATOR . "myConfig.ini";
		$configFile = parse_ini_file($configPath);
		return $configFile;
	}
}

if (isset($_POST['getInstanceID']) && isset($_POST['getInstanceImage'])) {
	echo OCI_API::getInstanceIPByImageName($_POST['getInstanceID'], $_POST['getInstanceImage']);
}

?>