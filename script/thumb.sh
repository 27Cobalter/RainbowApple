#!/bin/bash

LOCKFILE="/tmp/thumb.lock"

(
	flock -w 10 -x 200 || {
		echo "ERROR: timeout" 1>&2
		exit 1;
	}

	php ./thumb.php
) 200> "${LOCKFILE}"
