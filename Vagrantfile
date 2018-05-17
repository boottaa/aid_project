# -*- mode: ruby -*-
# vi: set ft=ruby :

VAGRANTFILE_API_VERSION = '2'

@script = <<SCRIPT
# Install dependencies
sudo su
apt-add-repository ppa:ondrej/php
apt-get update
apt-get install -y php php7.2-bcmath php7.2-bz2 php7.2-cli php7.2-curl php7.2-intl php7.2-json php7.2-mbstring php7.2-opcache php7.2-soap php7.2-sqlite3 php7.2-xml php7.2-xsl php7.2-zip php7.2-mysql libapache2-mod-php7.2 mcrypt php7.2-mbstring phpunit

# Configure Apache
echo '<VirtualHost *:80>
	DocumentRoot /var/www/public
	AllowEncodedSlashes On

	<Directory /var/www/public>
		Options +Indexes +FollowSymLinks
		DirectoryIndex index.php index.html
		Order allow,deny
		Allow from all
		AllowOverride All
	</Directory>

	ErrorLog ${APACHE_LOG_DIR}/error.log
	CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf
a2enmod rewrite
service apache2 restart

if [ -e /usr/local/bin/composer ]; then
    /usr/local/bin/composer self-update
else
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
fi

# Reset home directory of vagrant user
if ! grep -q "cd /var/www" /home/vagrant/.profile; then
    echo "cd /var/www" >> /home/vagrant/.profile
fi


SCRIPT


@mysql = <<MYSQL
sudo su

echo "** [ZF] Run install MySql:"
debconf-set-selections <<< 'mysql-server mysql-server/root_password password password'
debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password password'
apt-get install -y mysql-server-5.7

mysql -uroot -ppassword -e "CREATE DATABASE aid;"
mysql -uroot -ppassword -e "CREATE USER 'bootta'@'%' IDENTIFIED BY '1991';"
mysql -uroot -ppassword -e "GRANT ALL PRIVILEGES ON * . * TO 'bootta'@'%';"

mysql -uroot -ppassword aid < /var/www/data/Aid_api_access.sql
mysql -uroot -ppassword aid < /var/www/data/Aid_employee.sql
mysql -uroot -ppassword aid < /var/www/data/Aid_employee_profession.sql
mysql -uroot -ppassword aid < /var/www/data/Aid_orders.sql
mysql -uroot -ppassword aid < /var/www/data/Aid_profession.sql

echo "** [ZF] Run the following command to install dependencies, if you have not already:"
echo "    vagrant ssh -c 'composer install'"
echo "** [ZF] Visit http://192.168.33.11:80 in your browser for to view the application **"
MYSQL

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  config.vm.box = 'bento/ubuntu-18.04'
#  config.vm.network "forwarded_port", guest: 80, host: 8080
  config.vm.network "private_network", ip: "192.168.33.11"
  config.vm.synced_folder '.', '/var/www'
 config.vm.synced_folder  '../test', '/var/test', mount_options: ["dmode=777,fmode=666"]
  config.vm.provision 'shell', inline: @script
  config.vm.provision 'shell', inline: @mysql

  config.vm.provider "virtualbox" do |vb|
    vb.customize ["modifyvm", :id, "--memory", "1024"]
    vb.customize ["modifyvm", :id, "--name", "ZF Application - Ubuntu 14.04"]
  end
end
