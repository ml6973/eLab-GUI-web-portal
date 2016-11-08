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

<h2>It should run the python script</h2>
<?php 

$registerCMD = escapeshellcmd('C:\Python27\python ' . dirname(__FILE__) . DIRECTORY_SEPARATOR . '../resources/register.py testuser test@gdail.com passpass 2');
exec($registerCMD, $output, $exit);

print_r($output);
echo '<br><br>';
print_r($exit);
echo '<br><br>';
echo "Working...";

?>


</body>
</html>