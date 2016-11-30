<?php
include_once("../models/MongoDatabase.class.php");
include_once("../models/Messages.class.php");

echo "<h1>Tests for MongoDatabase class</h1>";
echo "<h2>It should create a database connection the first time called</h2>";
$myDb = MongoDatabase::getConnection();
echo "<h2>It should not open another connection if called again</h2>";
$myDb = MongoDatabase::getConnection();
echo "<h2>It should not open another connection if called another time</h2>";
$myDb = MongoDatabase::getConnection();
?>