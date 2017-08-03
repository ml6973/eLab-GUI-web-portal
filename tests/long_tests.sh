cp /var/www/myConfig.ini ..
cd unit/models
declare -A return_codes

echo "------DatabaseTest.php-----"
phpunit DatabaseTest.php
return_codes[DatabaseTest]="$?"

echo -e "\n------DBMaker.php-----"
phpunit DBMaker.php
return_codes[DBMaker]="$?"

echo -e "\n------DBMakerTest.php-----"
phpunit DBMakerTest.php
return_codes[DBMakerTest]="$?"

echo -e "\n------MessagesTest.php-----"
phpunit MessagesTest.php
return_codes[MessagesTest]="$?"

echo -e "\n------UserDataDBTest.php-----"
phpunit UserDataDBTest.php
return_codes[UserDataDBTest]="$?"

echo -e "\n------UserDataTest.php-----"
phpunit UserDataTest.php
return_codes[UserDataTest]="$?"

echo -e "\n------UsersDBTest.php-----"
phpunit UsersDBTest.php
return_codes[UsersDBTest]="$?"

echo -e "\n------UserTest.php-----"
phpunit UserTest.php
return_codes[UserTest]="$?"



echo "=============================="
failures=0
for testname in ${!return_codes[@]}; 
  do echo -e "$testname:\t error code ${return_codes[$testname]}";
  if [ ${return_codes[$testname]} -ne 0 ]
  then
    failures=1
  fi
done

rm ../../../myConfig.ini
exit $failures
