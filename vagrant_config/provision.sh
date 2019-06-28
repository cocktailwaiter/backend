#!/usr/bin/env bash

# yumで必要なものインストール
sudo yum install -y vim git zip unzip

# PHPインストール
sudo yum install -y https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm
sudo yum install -y yum-utils
sudo yum install -y http://rpms.remirepo.net/enterprise/remi-release-7.rpm
sudo yum-config-manager --enable remi-php73
sudo yum install -y php73 php73-php-fpm php73-php-mysqlnd php73-php-opcache php73-php-xml php73-php-xmlrpc php73-php-gd php73-php-mbstring php73-php-json
sudo ln -s /usr/bin/php73 /usr/bin/php
sudo systemctl enable php73-php-fpm.service

# composerインストール
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
composer global require "laravel/installer"

# ポート開放(SELinux無効化)
sudo cp /vagrant/vagrant_config/etc/selinux/config /etc/selinux/config
sudo systemctl restart firewalld
sudo firewall-cmd --permanent --zone=public --add-service=http
sudo firewall-cmd --permanent --zone=public --add-service=https
sudo firewall-cmd --reload
sudo setenforce 0

# Nginxのインストール
sudo yum install -y nginx
sudo cp /vagrant/vagrant_config/etc/nginx/nginx.conf /etc/nginx/nginx.conf
sudo systemctl start nginx
sudo systemctl enable nginx
sudo systemctl start php73-php-fpm.service

# MySQLのインストールここから
sudo rpm -ivh https://dev.mysql.com/get/mysql80-community-release-el7-1.noarch.rpm
sudo yum install -y mysql-community-server --enablerepo=mysql80-community

# 必要最小限のMySQLの設定内容を書き込む
cat << __CONF__ >> /etc/my.cnf
character-set-server = utf8
default_password_lifetime = 0
__CONF__

sudo systemctl enable mysqld
sudo systemctl start mysqld

password=`cat /var/log/mysqld.log | grep "A temporary password" | tr ' ' '\n' | tail -n1` # 初期パスワードを取得する
new_password=P@ssw0rd
sudo mysql -u root -p${password} --connect-expired-password -e "ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY '${new_password}'"
sudo mysql -u root -p${new_password} --connect-expired-password < /vagrant/vagrant_config/db/cocktailwaiter.sql
# MySQLのインストールここまで

# ついで
sudo yum install -y htop
