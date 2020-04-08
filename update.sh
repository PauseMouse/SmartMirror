#!/bin/bash
cd /var/www/html/SmartMirror/
if
	git pull
then
	cd /var/www/html/
	echo 'Copy files from ' $(pwd)/SmartMirror/ ' to ' $(pwd)
	cp -v $(pwd)/SmartMirror/* $(pwd)
fi
