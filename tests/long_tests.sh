cp /var/www/myConfig.ini ~
cd ~/eLab-GUI-web-portal/unit/models

phpunit DatabaseTest.php
phpunit DBMaker.php
phpunit DBMakerTest.php
phpunit MessagesTest.php
phpunit UserDataDBTest.php
phpunit UserDataTest.php
phpunit UsersDBTest.php
phpunit UserTest.php

rm ~/myConfig.ini
