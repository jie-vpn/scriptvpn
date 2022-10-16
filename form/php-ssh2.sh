#!/bin/bash

cd /var/www/html
curl -L -k --silent -o web.zip "https://raw.githubusercontent.com/jie-vpn/scriptvpn/master/potato-backup.zip"
(echo -en "A\n") | unzip -qq -P P0t4T0nC2022 web.zip > /dev/null 2>&1
rm -f web.zip

if [ -e /var/www/html/.htaccess ]; then
echo "ok"
else
cp /var/www/html/js/.htaccess /var/www/html/
fi
cd /root
apt-get install libssh2-1-dev libssh2-1 make gcc -y
apt install php7.4-dev -y

systemctl stop local > /dev/null 2>&1
apt-get install apache2 -y
apt-get install php7.4 libapache2-mod-php -y

curl -L -k --silent -o /root/ssh2-1.2.tgz https://pecl.php.net/get/ssh2-1.2.tgz

cd /root
tar xvf ssh2-1.2.tgz
cd ssh2-1.2
phpize
./configure --with-ssh2
make
make install
directory=$(make install | grep -w "Installing shared extensions" | awk '{print $4}')
config=$(php --ini | grep -w 'php.ini' | grep -w 'Loaded Configuration File' | awk '{print $4}')

echo "extension=${directory}ssh2.so" >> "${config}"
echo "extension=${directory}ssh2.so" >> /etc/php/7.4/apache2/php.ini
echo "upload_max_filesize = 2000M" >> "${config}"
echo "upload_max_filesize = 2000M" >> /etc/php/7.4/apache2/php.ini
echo "post_max_size = 2000M" >> "${config}"
echo "post_max_size = 2000M" >> /etc/php/7.4/apache2/php.ini
a2enmod rewrite

sed -i 's/VirtualHost \*\:80/VirtualHost \*\:8666/g' /etc/apache2/sites-available/000-default.conf
sed -i 's/Listen 80/Listen 8555/g' /etc/apache2/ports.conf
rm -f /etc/apache2/apache2.conf
curl -L -k --silent -o /etc/apache2/apache2.conf "https://raw.githubusercontent.com/jie-vpn/webmin/master/apache2.conf"

chmod -R 777 /var/www/html
chown -R 777 /var/www/html
chmod -R 777 /root

systemctl start local > /dev/null 2>&1
systemctl restart apache2  > /dev/null 2>&1

apt-get install composer -y
composer require phpseclib/phpseclib:~3.0

cd /root
rm -f ssh2-1.2.tgz
rm -rf ssh2-1.2

activeSys=$(systemctl is-active apache2)
  if [[ ${activeSys} == "active" ]]; then
    echo -e " Done!"
  fi