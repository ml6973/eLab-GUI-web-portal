<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for makeMongo</title>
</head>
<body>
<h1>makeMongo tests</h1>

<?php
include_once("../models/MongoDatabase.class.php");
include_once("../models/Messages.class.php");
include_once("./makeMongo.php");
include_once("../libraries/Spyc.class.php");
?>

<h1>Builds Mongo database using prepared mongo documents</h1>

<?php
makeMongo();
?>

</body>
</html>