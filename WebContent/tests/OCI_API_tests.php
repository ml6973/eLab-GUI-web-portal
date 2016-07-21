<!DOCTYPE html>
<html>
<head>
</head>
<body>
<h1>OCI API tests</h1>

<?php
include_once("../models/OCI_API.class.php");
include_once("../models/User.class.php");
include_once("../models/UserData.class.php");
include_once("../models/Messages.class.php");

set_time_limit(120);
?>

<h2>It should grab the course catalog</h2>
<?php 

$catalog = OCI_API::getCatalog();
print_r($catalog);

?>

<h2>It should register a user </h2>
<?php 

$validTest = array("userName" => "ghooks", "password" => "test");
$s1 = new User($validTest);
$s1->setUserId(4);

$validTest = array("email" => "test@gdail.com",
		"vmPassword" => "testpassword"
);
$s2 = new UserData($validTest);

OCI_API::registerUser($s1, $s2);

?>

<h2>It should retrieve a list of instances for a user</h2>
<?php 
$instances = OCI_API::getInstances($s1->getUserId());
print_r($instances);

?>


</body>
</html>

