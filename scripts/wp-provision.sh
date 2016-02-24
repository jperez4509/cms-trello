#!/bin/bash

# simple vagrant provisioning script

# some coloring in outputs.
COLOR="\033[;35m"
COLOR_RST="\033[0m"

echo -e "${COLOR}---updating system---${COLOR_RST}"
apt-get update

echo -e "${COLOR}---installing some tools: zip,unzip,curl, python-software-properties---${COLOR_RST}"

apt-get install -y software-properties-common
apt-get install -y python-software-properties
apt-get install -y zip unzip
apt-get install -y curl
apt-get install -y build-essential
apt-get install -y vim

#tmux & node ppas
add-apt-repository -y ppa:pi-rho/dev
add-apt-repository -y ppa:chris-lea/node.js

apt-get update
apt-get install -y tmux
apt-get install -y python g++ make nodejs

# installing mysql
# pre-loading a default password --> yourpassword
debconf-set-selections <<< "mysql-server mysql-server/root_password password secret"
debconf-set-selections <<< "mysql-server mysql-server/root_password_again password secret"
echo -e "${COLOR}---installing MySql---${COLOR_RST}"
sudo apt-get install -y mysql-server mysql-client

# installing apache2
echo -e "${COLOR}---installing Apache---${COLOR_RST}"
sudo apt-get install -y apache2
sudo rm -rf /var/www/html
sudo ln -fs /vagrant /var/www/html

# installing php 5
echo -e "${COLOR}---installing php---${COLOR_RST}"
apt-get install -y php5 libapache2-mod-php5 php5-mcrypt php5-curl php5-mysql php5-xdebug php5-gd

# sudo apt-get install php7.0
# sudo apt-get install php7.0-cli php7.0-common libapache2-mod-php7.0 php7.0 php7.0-mysql php7.0-fpm php7.0-curl php7.0-json php7.0-cgi php7.0-mcrypt

#setup the database
cd /vagrant
#mysql -u root -psecret -e "DROP DATABASE IF EXISTS wordpress;"
#mysql -u root -psecret -e "create database wordpress;"

# enable mod rewrite for apache2
echo -e "${COLOR}---enabling rewrite module---${COLOR_RST}"
if [ ! -f /etc/apache2/mods-enabled/rewrite.load ] ; then
    a2enmod rewrite
fi

#deflat module for apache2
if [ ! -f /etc/apache2/mods-enabled/deflate.load ] ; then
    a2enmod deflate
fi

# restart apache2
echo -e "${COLOR}---restarting apache2---${COLOR_RST}"
service apache2 restart

# install wordpress
echo -e "${COLOR}---installing wordpress---${COLOR_RST}"
cd /var/www/html
sudo wget http://wordpress.org/latest.tar.gz
sudo tar xfz latest.tar.gz
mv wordpress/* ./
rmdir ./wordpress/
rm -f latest.tar.gz