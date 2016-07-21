<!DOCTYPE html>
<html>
<head>
</head>
<body>
<h1>OCI API tests</h1>

<?php
include_once("../models/OCI_API.class.php");
?>

<h2>It should grab the course catalog</h2>
<?php 

OCI_API::getCatalog();

?>


</body>
</html>

