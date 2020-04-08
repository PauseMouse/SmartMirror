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

	echo 'Moving files from ' $(pwd)/SmartMirror/ ' to ' $(pwd)
	mv -v $(pwd)/SmartMirror/* $(pwd)
	rm -rf $(pwd)/SmartMirror/
else
	echo 'Unable to install'
	exit;
fi

echo 'Copy new install.sh to /home/pi/'
cp $(pwd)/install.sh /home/pi/

# load chromium after boot and open the smartmirror website in full screen mode
mkdir -p /home/pi/.config/lxsession/LXDE-pi/
cd /home/pi/.config/lxsession/LXDE-pi/

#echo "@xset s off" > autostart
#echo "@xset -dpms" > autostart
#echo "@xset s noblank" > autostart
echo "@chromium --kiosk localhost" > autostart
# load chromium after boot and open the smartmirror website in full screen mode

echo "reboot"
reboot
