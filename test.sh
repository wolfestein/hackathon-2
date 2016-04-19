#!/bin/sh

./lol.phar LevelA;
LEVELA=$?;
SCORE=0;
if [ $LEVELA = 0 ]; then
        SCORE=5;
fi

./lol.phar LevelB;
LEVELB=$?;
if [ $LEVELB = 0 ]; then
        SCORE=$((SCORE+7));
fi

./lol.phar LevelC;
LEVELC=$?;
if [ $LEVELC = 0 ]; then
        SCORE=$((SCORE+10));
fi

./lol.phar LevelD;
LEVELD=$?;
if [ $LEVELD = 0 ]; then
        SCORE=$((SCORE+18));
fi

./lol.phar LevelE;
LEVELE=$?;
if [ $LEVELE = 0 ]; then
        SCORE=$((SCORE+30));
fi

./lol.phar LevelF;
LEVELF=$?;
if [ $LEVELF = 0 ]; then
        SCORE=$((SCORE+50));
fi

./lol.phar LevelG;
LEVELG=$?;
if [ $LEVELG = 0 ]; then
        SCORE=$((SCORE+80));
fi

NAME='plop';
if [ $1 ]; then
        NAME=$1;
fi

DATE='000000';
if [ $2 ]; then
        DATE=$2
fi

echo "SCORE:"$SCORE
echo "$NAME;$DATE;$SCORE" >> ../../../scores.csv
