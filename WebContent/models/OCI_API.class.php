<?php
class OCI_API {
	
	public static function getCatalog() {
		$ch = curl_init();
		
		curl_setopt($ch, CURLOPT_URL, "http://129.114.110.218:12345/catalog/");
		curl_setopt($ch, CURLOPT_HEADER, 0);
		
		$response = curl_exec($ch);
		
		curl_close($ch);
		
		return($response);
	}
	
	public static function registerUser($user, $userData) {
	
		$json = array("api_uname" => "webportal", 
						"api_pass" => "greg123",
						"username" => $user->getUserName(), 
						"email" => $userData->getEmail(), 
						"preferred_pass" => $userData->getVMPassword(), 
						"external_id" => $user->getUserId());
		$json = json_encode($json);
	
		$ch = curl_init();
	
		curl_setopt($ch, CURLOPT_URL, "http://129.114.110.218:12345/register/");
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Content-Type: application/json',
				'Content-Length: ' . strlen($json))
				);
	
		$response = curl_exec($ch);
	
		curl_close($ch);
	
		return($response);
	}
	
	public static function getInstances($userID) {
		
		$json = array("api_uname" => "webportal", 
						"api_pass" => "greg123", 
						"userid" => $userID);
		$json = json_encode($json);
		
		$ch = curl_init();
	
		curl_setopt($ch, CURLOPT_URL, "http://129.114.110.218:12345/lablist/");
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    		'Content-Type: application/json',
    		'Content-Length: ' . strlen($json))
		);
	
		$response = curl_exec($ch);
	
		curl_close($ch);
	
		return($response);
	}
}
?>