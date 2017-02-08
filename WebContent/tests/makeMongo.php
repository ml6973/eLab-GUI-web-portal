<?php
function makeMongo() {
	$pathDir = dirname(__FILE__);  //Initialize the path directory
	$fullPath = $pathDir . DIRECTORY_SEPARATOR . "../resources/marketPlaceData/";
	
	if (file_exists($fullPath) && is_dir($fullPath)){
		$files = scandir($fullPath);
		$files = array_diff($files, array('.', '..'));
	}
	
	//Get connection and 
	$db = MongoDatabase::getConnection();
	
	//Clear database for re-initialization
	$db->drop();
	
	//Select the collection we will store the course data
	$courses = $db->selectCollection('courseData');
	$gridFS = $db->getGridFS();
	
	//Go through each marketplace file and create a document for Mongo Storage
	foreach($files as $file) {
		if (file_exists($fullPath.$file.DIRECTORY_SEPARATOR."header.yaml") && file_exists($fullPath.$file.DIRECTORY_SEPARATOR."details.md") && file_exists($fullPath.$file.DIRECTORY_SEPARATOR."thumbnail.jpg")) {
			$marketYaml = Spyc::YAMLLoad($fullPath.$file.DIRECTORY_SEPARATOR."header.yaml");
			
			$id = $gridFS->storeFile($fullPath.$file.DIRECTORY_SEPARATOR."thumbnail.jpg");
			$detailsID = $gridFS->storeFile($fullPath.$file.DIRECTORY_SEPARATOR."details.md");
	
			if (strcmp($marketYaml[0]['contentType'], "course") == 0) {
				$description = "";
				if (is_array($marketYaml[0]["description"])){
					foreach ($marketYaml[0]["description"] as $sentence) {
						$description = $description.$sentence."\n";
					}
				}else{
					$description = $marketYaml[0]["description"];
				}
				
			    $marketPlaceObject = array(
			    		                   'identifier' => "marketPlaceObject",
			    		                   'title' => $marketYaml[0]['title'],
			    		                   'description' => $description,
			    		                   'image' => $marketYaml[0]['image'],
			    		                   'type' => $marketYaml[0]['type'],
								    	   'category' => $marketYaml[0]['category'],
								    	   'contentType' => $marketYaml[0]['contentType'],
			    						   'applications' => array(),
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
	}
	
	//Go through each marketplace file and check for applications and associate with their parents
	foreach($files as $file) {
		if (file_exists($fullPath.$file.DIRECTORY_SEPARATOR."header.yaml") && file_exists($fullPath.$file.DIRECTORY_SEPARATOR."details.md") && file_exists($fullPath.$file.DIRECTORY_SEPARATOR."thumbnail.jpg")) {
			$marketYaml = Spyc::YAMLLoad($fullPath.$file.DIRECTORY_SEPARATOR."header.yaml");
				
			$id = $gridFS->storeFile($fullPath.$file.DIRECTORY_SEPARATOR."thumbnail.jpg");
			$detailsID = $gridFS->storeFile($fullPath.$file.DIRECTORY_SEPARATOR."details.md");
	
			if (strcmp($marketYaml[0]['contentType'], "application") == 0) {
				$applicationObject = array(
						'identifier' => "applicationObject",
						'title' => $marketYaml[0]['title'],
						'ip' => $marketYaml[0]['ip'],
						'type' => $marketYaml[0]['type'],
						'category' => $marketYaml[0]['category'],
						'contentType' => $marketYaml[0]['contentType'],
						'parent' => $marketYaml[0]['parentimage'],
						'mtitle' => $marketYaml[0]['markettitle'],
						'organization' => $marketYaml[0]['organization'],
						'thumbnail' => $id,
						'details' => $detailsID
				);
				$courses->save($applicationObject);
				
				//Associate the application with its parent
				$parent = $courses->findOne( array("identifier" => "marketPlaceObject", "image" => $applicationObject['parent']) );
				$parent["applications"][] = $applicationObject['_id'];
				$courses->save($parent);
			}
		}
	}
    
	//Test retrieval for marketplace objects
    $results = $courses->find( array("identifier" => "marketPlaceObject") );
    foreach ($results as $course) {
    	print_r($course);
    	echo "<br>";
    	echo '<img src="data:image/jpg;base64,'.base64_encode($gridFS->findOne(array("_id" => $course['thumbnail']))->getBytes()).'">';
    	echo "<br>";
    	$ParseDown = new ParsedownExtra();
    	echo $ParseDown->text($gridFS->findOne(array("_id" => $course['details']))->getBytes());
    	echo "<br><br><br>";
    }
    
    //Go through each course file and create the appropriate mongo documents
    $fullPath = $pathDir . DIRECTORY_SEPARATOR . "../resources/courseData/courses/";
    if (file_exists($fullPath) && is_dir($fullPath)){
    	$files = scandir($fullPath);
    	$files = array_diff($files, array('.', '..'));
    	sort($files, SORT_REGULAR | SORT_NATURAL);
    }
    $videoFile = $pathDir . DIRECTORY_SEPARATOR . "../resources/courseData/videos/videos.yaml";
    $videoyaml = Spyc::YAMLLoad($videoFile);
    foreach($files as $file) {
    	$courseYaml = Spyc::YAMLLoad($fullPath.$file);
    	if (!array_key_exists("type", $courseYaml[0])) {
    		$courseYaml[0]['type'] = "ssh";
    	}
    	if (!array_key_exists("lessonlink", $courseYaml[0])) {
    		$courseYaml[0]['lessonlink'] = "";
    	}
    	
    	$topicsArray = array();
    	$topics = Spyc::YAMLLOAD($pathDir . DIRECTORY_SEPARATOR . "../resources/courseData/topics/" . $courseYaml[0]['topicFile']);
    	foreach ($topics as $topic) {
    		$postsArray = array();
    		$postPath = $pathDir . DIRECTORY_SEPARATOR . "../resources/courseData/posts/" . $topic['link'] . "/";
    		$posts = scandir($postPath);
    		$posts = array_diff($posts, array('.', '..'));
    		sort($posts, SORT_REGULAR | SORT_NATURAL);
    		foreach ($posts as $post) {
    			if (preg_match('/\.md$/', $post)) {
	    			$postContents = preg_split('/---/', file_get_contents($postPath.$post), 3);
					$postAttributes = preg_replace('/:[\s\t]/', ':', $postContents[1]);
					$postAttributes = preg_replace('/[\n\r]+/', "\n", $postAttributes);
					$postAttributes = preg_split('/[:\n\r]/', $postAttributes);
					if (empty($postAttributes[0]))
						$number = 4;
					else
						$number = 3;
					
					$videoLink = "";
					foreach($videoyaml as $video) {
						if (strcmp($video['title'], $postAttributes[$number]) == 0){
							$videoLink = $video['code'];
							$videoContents = preg_split('/ /', $videoLink);
							$videoLink = $videoContents[4];
							$videoLink = preg_replace('/src=/', "", $videoLink);
							$videoLink = preg_replace('/"/', "", $videoLink);
						}
					}
					
					$postID = $gridFS->storeBytes($postContents[2]);
					$postObject = array(
							'identifier' => "postObject",
							'title' => $postAttributes[$number],
							'description' => $postAttributes[$number+6],
							'author' => $postAttributes[$number+4],
							'layout' => $postAttributes[$number-2],
							'video' => $videoLink,
							'post' => $postID
					);
					$courses->save($postObject);
					array_push($postsArray, $postObject['_id']);
    			}
    		}
    		
    		$topicObject = array(
    				'identifier' => "topicObject",
    				'title' => $topic['title'],
    				'description' => $topic['description'],
    				'posts' => $postsArray
    		);
    		$courses->save($topicObject);
    		array_push($topicsArray, $topicObject['_id']);
    	}
    	
    	$courseObject = array(
    			'identifier' => "courseObject",
    			'title' => $courseYaml[0]['title'],
    			'description' => $courseYaml[0]['description'],
    			'image' => $courseYaml[0]['image'],
    			'type' => $courseYaml[0]['type'],
    			'category' => $courseYaml[0]['category'],
    			'contentType' => $courseYaml[0]['contentType'],
    			'link' => $courseYaml[0]['lessonlink'],
    			'topics' => $topicsArray
    	);
    	$courses->save($courseObject);
    }
    
    //Print one course for relationship verification
    $result = $courses->findOne( array("identifier" => "courseObject") );
    echo "<br><br><br>";
    print_r($course);
    echo "<br>";
    $topic = $courses->findOne( array('_id' => $result['topics'][0]) );
    print_r($topic);
    echo "<br>";
    $post = $courses->findOne( array('_id' => $topic['posts'][0]) );
    print_r($post);
    echo "<br>";
    $ParseDown = new ParsedownExtra();
    echo $ParseDown->text($gridFS->findOne(array("_id" => $post['post']))->getBytes());
    echo "<br><br><br>";
}

?>