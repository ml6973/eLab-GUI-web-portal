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

<h2>It should retrieve a a specific instance for a user</h2>
<?php 

$imageName = "cirros-0.3.4-x86_64-uec-kernel";
$instance = OCI_API::getInstanceByImageName($s1->getUserId(), $imageName);
print_r($instance);

?>


</body>
</html>

