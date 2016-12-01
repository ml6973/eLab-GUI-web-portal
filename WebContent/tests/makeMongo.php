<?php
function makeMongo() {
	$pathDir = dirname(__FILE__);  //Initialize the path directory
	$fullPath = $pathDir . DIRECTORY_SEPARATOR . "../resources/marketPlaceData/";
	
	if (file_exists($fullPath) && is_dir($fullPath)){
		$files = scandir($fullPath);
		$files = array_diff($files, array('.', '..'));
	}
	
	//Get connection and select the collection we will store the course data
	$db = MongoDatabase::getConnection();
	$courses = $db->selectCollection('courseData');
	$gridFS = $db->getGridFS();
	
	//Go through each marketplace file and create a document for Mongo Storage
	foreach($files as $file) {
		if (file_exists($fullPath.$file.DIRECTORY_SEPARATOR."header.yaml") && file_exists($fullPath.$file.DIRECTORY_SEPARATOR."details.md") && file_exists($fullPath.$file.DIRECTORY_SEPARATOR."thumbnail.jpg")) {
			$marketYaml = Spyc::YAMLLoad($fullPath.$file.DIRECTORY_SEPARATOR."header.yaml");
			
			$id = $gridFS->storeFile($fullPath.$file.DIRECTORY_SEPARATOR."thumbnail.jpg");
			$detailsID = $gridFS->storeFile($fullPath.$file.DIRECTORY_SEPARATOR."details.md");
	
		    $marketPlaceObject = array(
		    		                   'identifier' => "marketPlaceObject",
		    		                   'title' => $marketYaml[0]['title'],
		    		                   'description' => $marketYaml[0]['description'],
		    		                   'image' => $marketYaml[0]['image'],
		    		                   'type' => $marketYaml[0]['type'],
		    		                   'link' => $marketYaml[0]['lessonlink'],
		    		                   'mtitle' => $marketYaml[0]['markettitle'],
		    		                   'organization' => $marketYaml[0]['organization'],
		    		                   'lessoncount' => $marketYaml[0]['lessoncount'],
		    		                   'thumbnail' => $id,
		    		                   'details' => $detailsID
		    );
		    $courses->save($marketPlaceObject);
		}
	}
    
    $results = $courses->find( array("identifier" => "marketPlaceObject") );
    foreach ($results as $course) {
    	print_r($course);
    	print "<br>";
    	echo '<img src="data:image/jpg;base64,'.base64_encode($gridFS->findOne(array("_id" => $course['thumbnail']))->getBytes()).'">';
    	print "<br>";
    	$ParseDown = new ParsedownExtra();
    	echo $ParseDown->text($gridFS->findOne(array("_id" => $course['details']))->getBytes());
    	print "<br><br><br>";
    }
}

?>