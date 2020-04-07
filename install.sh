#!/bin/bash
# This is an installer script. Created by the defelopers of Microsign Bedrijfssoftware as a fun project.

echo 'Hello World!'

echo 'Check for updatable packages'
sudo apt update

echo 'Intall or Update Apache2'
sudo apt install apache2 -y

echo 'Install or Update PHP'
sudo apt install php libapache2-mod-php -y
