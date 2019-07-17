#!/bin/bash

date > /tmp/debug.log
echo "1" >> /tmp/debug.log
mkdir /tmp/simple.lock > /dev/null 2>&1
if [ $? -ne 0 ]; then
  echo "lock file is exists"
  echo "2" >> /tmp/debug.log
  exit 1
fi
while [ $(php update_simple.php | grep -v Exists | wc -l) -ne 0 ];do date > /tmp/log.txt;done

echo "3" >> /tmp/debug.log
rmdir /tmp/simple.lock
