#!/bin/bash

date > /tmp/debug.log
mkdir /tmp/simple.lock > /dev/null 2>&1
echo "1" >> /tmp/debug.log
if [ $? -ne 0 ]; then
  echo "2" >> /tmp/debug.log
  exit 1
fi
while [ $(php update_simple.php | grep -v Exists | wc -l) -ne 0 ];do date > /tmp/log.txt;done

echo "3" >> /tmp/debug.log
rmdir /tmp/simple.lock
