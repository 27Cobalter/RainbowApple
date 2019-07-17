#!/bin/bash

date > /tmp/debug.log
if [ ! -e $1 ]; then
  echo "file not exists $1" >> /tmp/debug.log
  exit 1
fi
echo "file exists $1" >> /tmp/debug.log
php ./generate_simple.php $1 >> /tmp/debug.log
