cp /var/www/myConfig.ini ..
cd unit/models

echo "------DatabaseTest.php-----"
phpunit DatabaseTest.php
echo "\n------DBMaker.php-----"
phpunit DBMaker.php
echo "\n------DBMakerTest.php-----"
phpunit DBMakerTest.php
echo "\n------MessagesTest.php-----"
phpunit MessagesTest.php
echo "\n------UserDataDBTest.php-----"
phpunit UserDataDBTest.php
echo "\n------UserDataTest.php-----"
phpunit UserDataTest.php
echo "\n------UsersDBTest.php-----"
phpunit UsersDBTest.php
echo "\n------UserTest.php-----"
phpunit UserTest.php


rm ../../../myConfig.ini
