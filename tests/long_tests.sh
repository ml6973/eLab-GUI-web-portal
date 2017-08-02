cp /var/www/myConfig.ini ..
cd unit/models

echo "------DatabaseTest.php-----"
phpunit DatabaseTest.php
echo "------DatabaseTest.php-----"
phpunit DBMaker.php
echo "------DatabaseTest.php-----"
phpunit DBMakerTest.php
echo "------DatabaseTest.php-----"
phpunit MessagesTest.php
echo "------DatabaseTest.php-----"
phpunit UserDataDBTest.php
echo "------DatabaseTest.php-----"
phpunit UserDataTest.php
echo "------DatabaseTest.php-----"
phpunit UsersDBTest.php
echo "------DatabaseTest.php-----"
phpunit UserTest.php


rm ../../../myConfig.ini
