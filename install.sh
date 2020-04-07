#!/bin/bash
# This is an installer script. Created by the defelopers of Microsign Bedrijfssoftware as a fun project.

echo 'Hello World!'

echo 'Check for updatable packages'
sudo apt update

echo 'Intall Apache2'
sudo apt install apache2 -y
