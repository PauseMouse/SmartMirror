#!/bin/bash
# This is an installer script. Created by the defelopers of Microsign Bedrijfssoftware as a fun project.
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
	[[ -d "/var/www/html/SmartMirror/" ]]
then
	bash update.sh
else
	if
		git clone --depth=1 https://github.com/PauseMouse/SmartMirror.git;
	then
		echo 'Cloned to ' $(pwd);

		echo 'Copy files from ' $(pwd)/SmartMirror/ ' to ' $(pwd)
		cp -v $(pwd)/SmartMirror/* $(pwd)
	else
		echo 'Unable to install'
		exit;
	fi
fi

echo 'Fix rewrite rules'
sudo a2enmod rewrite
sudo systemctl restart apache2
sudo chmod -R 777 /etc/apache2/sites-available/000-default.conf
cp $(pwd)/000-default.conf /etc/apache2/sites-available/000-default.conf
sudo systemctl restart apache2

echo 'Copy new install.sh to /home/pi/'
cp $(pwd)/install.sh /home/pi/

echo 'Copy new update.sh to /home/pi/'
cp $(pwd)/update.sh /home/pi/

#schedule update task
echo 'Just press [Enter] if you do not know what option is best.'
read -p "Do you want to schedule auto updates? (Y/N default Y)? " choice
choice="${choice:-Y}"
if [[ $choice =~ ^[Yy]$ ]]; then
	echo 'Sceduling Task'
	cd /var/www/html/
	chmod +X update.sh
	(crontab -l 2>/dev/null || true; echo "0 0 * * * /var/www/html/update.sh") | crontab -
	echo 'Starting cron'	
	sudo service cron start
	echo 'Update cron defaults'
	sudo update-rc.d cron defaults
else
	echo 'To manualy update run bash update.sh'
fi
#schedule update task

# load chromium after boot and open the smartmirror website in full screen mode
echo 'Just press [Enter] if you do not know what option is best.'
read -p "Do you want auto start SmartMirror in full screen? (Y/N default Y)? " choice
choice="${choice:-Y}"
if [[ $choice =~ ^[Yy]$ ]]; then

	echo 'Install unclutter to hide the cursor'
	sudo apt install unclutter 
	
	echo 'Start chromium in kiosk mode'
	mkdir -p /home/pi/.config/lxsession/LXDE-pi/
	cd /home/pi/.config/lxsession/LXDE-pi/

	#echo "@xset s off" > autostart
	#echo "@xset -dpms" > autostart
	#echo "@xset s noblank" > autostart
	echo "@chromium --kiosk localhost/SmartMirror" > autostart
fi
# load chromium after boot and open the smartmirror website in full screen mode

echo "reboot"
reboot
