#!/bin/bash
# This is an installer script. Created by the defelopers of Microsign Bedrijfssoftware as a fun project.

echo 'Hello World!'

echo 'Check for updatable packages'
sudo apt update

echo 'Intall or Update Apache2'
sudo apt install apache2 -y

echo 'Install or Update PHP'
sudo apt install php libapache2-mod-php -y

echo 'Go to html root'
cd /var/www/html

# start fixup permissions
sudo chmod -R 777 $(pwd)
# end fixup permissions

echo 'Remove defauld index.htm'
sudo rm index.html

if 
	git clone --depth=1 https://github.com/PauseMouse/SmartMirror.git;
then
	echo 'Cloned to ' $(pwd);
else
	echo 'Unable to install'
	exit;
fi
