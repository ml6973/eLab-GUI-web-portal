<?php
class OCI_API {
	
	public static function getCatalog() {
		$ch = curl_init();
		
		curl_setopt($ch, CURLOPT_URL, "https://129.114.110.199:8000/catalog/");
		curl_setopt($ch, CURLOPT_HEADER, 0);
		
		$response = curl_exec($ch);
		
		curl_close($ch);
		
		print_r($response);
	}
}
?>