#!/bin/sh
NAME=$1;
echo $NAME;

DATE=$2;
echo $DATE;

wget https://phar.phpunit.de/phpunit-old.phar
mv phpunit-old.phar lol.phar
chmod +x lol.phar

composer install;
chmod +x test.sh;
./test.sh $NAME $DATE;
