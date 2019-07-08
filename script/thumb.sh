#!/bin/bash

mkdir /tmp/rainbow.lock > /dev/null 2>&1
if [ $? -ne 0 ]; then
  exit 1
fi
while [ $(php thumb.php | grep -v exists | wc -l) -ne 0 ];do date > /tmp/log.txt;done

rmdir /tmp/rainbow.lock
