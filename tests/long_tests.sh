cp /var/www/myConfig.ini ../..
cd unit/models

echo "------DatabaseTest.php-----"
phpunit DatabaseTest.php
echo -e "\n------DBMaker.php-----"
phpunit DBMaker.php
echo -e "\n------DBMakerTest.php-----"
phpunit DBMakerTest.php
echo -e "\n------MessagesTest.php-----"
phpunit MessagesTest.php
echo -e "\n------UserDataDBTest.php-----"
phpunit UserDataDBTest.php
echo -e "\n------UserDataTest.php-----"
phpunit UserDataTest.php
echo -e "\n------UsersDBTest.php-----"
phpunit UsersDBTest.php
echo -e "\n------UserTest.php-----"
phpunit UserTest.php


rm ../../../myConfig.ini
