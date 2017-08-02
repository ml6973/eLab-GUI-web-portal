cp /var/www/myConfig.ini ..
cd unit/models

echo "------DatabaseTest.php-----"
phpunit DatabaseTest.php
echo "------DBMaker.php-----"
phpunit DBMaker.php
echo "------DBMakerTest.php-----"
phpunit DBMakerTest.php
echo "------MessagesTest.php-----"
phpunit MessagesTest.php
echo "------UserDataDBTest.php-----"
phpunit UserDataDBTest.php
echo "------UserDataTest.php-----"
phpunit UserDataTest.php
echo "------UsersDBTest.php-----"
phpunit UsersDBTest.php
echo "------UserTest.php-----"
phpunit UserTest.php


rm ../../../myConfig.ini
