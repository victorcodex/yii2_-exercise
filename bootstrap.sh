#! /usr/bin/env bash

# Variables
DBHOST=localhost
DBPORT=5432
DBUSER=test
DBPASSWD=r4shXqJa
DBNAME=exercise
REMOTE_HOST=10.0.2.2
REMOTE_NETWORK=10.0.2.0/24
GITHUB_TOKEN= TOKEN_HERE #replace with an actual valid token

echo -e "\n--- Set system encoding to UTF-8 ---\n"

echo 'LC_ALL="en_US.UTF-8"' > /etc/default/locale
locale-gen en_US.UTF-8 > /dev/null 2>&1
dpkg-reconfigure locales > /dev/null 2>&1

echo -e "\n--- Updating packages list ---\n"
apt-get -qq update

echo -e "\n--- Install base packages ---\n"
apt-get -y install vim curl wget zip unzip build-essential software-properties-common git debian-keyring apt-transport-https lsb-release ca-certificates > /dev/null 2>&1

echo -e "\n--- Add some repos to update our distro ---\n"
add-apt-repository 'deb http://packages.dotdeb.org jessie all'
add-apt-repository 'deb http://apt.postgresql.org/pub/repos/apt/ jessie-pgdg main 9.6'

echo -e "\n--- Get php 7.1 packages repo ---\n"
wget --quiet -O - https://packages.sury.org/php/apt.gpg | apt-key add - > /dev/null 2>&1
echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" > /etc/apt/sources.list.d/php.list

wget --quiet -O - http://www.dotdeb.org/dotdeb.gpg | apt-key add - > /dev/null 2>&1

echo -e "\n--- Import repository key for postgres ---\n"
wget --quiet -O - https://www.postgresql.org/media/keys/ACCC4CF8.asc | apt-key add - > /dev/null 2>&1

echo -e "\n--- Updating packages list ---\n"
apt-get -qq update

echo -e "\n--- Install PostgreSQL specific packages and settings ---\n"
apt-get -y install postgresql-9.6 postgresql-contrib-9.6 > /dev/null 2>&1
sed -i "s/#listen_addresses = 'localhost'/listen_addresses = '*'/g" /etc/postgresql/9.6/main/postgresql.conf > /dev/null 2>&1
echo "host all all $REMOTE_NETWORK md5" >> /etc/postgresql/9.6/main/pg_hba.conf

echo -e "\n--- Restarting Postgres ---\n"
sudo service postgresql restart > /dev/null 2>&1

echo -e "\n--- Setting up our PostreSQL user and databases ---\n"
echo -e "\n--- psql - change root password ---\n"
sudo -u postgres psql postgres -c "alter user postgres with password 'aY34h8JJ';" > /dev/null 2>&1
#
echo -e "\n--- psql - create user $DBUSER ---\n"
sudo -u postgres psql postgres -c "create user $DBUSER with password '$DBPASSWD';" > /dev/null 2>&1
#
echo -e "\n--- psql - create database $DBNAME ---\n"
sudo -u postgres psql postgres -c "create database $DBNAME --locale=en_US.utf8 with encoding='UTF8';" > /dev/null 2>&1
sudo -u postgres psql postgres -c "grant all privileges on database $DBNAME to $DBUSER;" > /dev/null 2>&1

echo -e "\n--- Installing PHP-specific packages ---\n"
apt-get -y install php7.1 apache2 libapache2-mod-php7.1 php7.1-mbstring php7.1-curl php7.1-intl php7.1-gd php7.1-mcrypt php7.1-pgsql php7.1-zip php7.1-xml

echo -e "\n--- Installing xdebug php package ---\n"
apt-get -y install php7.1-xdebug > /dev/null 2>&1

echo -e "\n--- Add environment variables ---\n"
cat > /etc/environment <<EOF
export DB_HOST=$DBHOST
export DB_PORT=$DBPORT
export DB_USER=$DBUSER
export DB_PASS=$DBPASSWD
export DB_NAME=$DBNAME
EOF

source /etc/environment

echo -e "\n--- Add environment variables to Apache ---\n"
cat <<EOF >> /etc/apache2/envvars
# Load all the system environment variables.
. /etc/environment
EOF

cat <<EOF >> /etc/php/7.1/mods-available/xdebug.ini
xdebug.default_enable = 1
xdebug.idekey = "vagrant"
xdebug.remote_enable = 1
xdebug.remote_autostart = 1
xdebug.remote_port = 9000
xdebug.remote_handler = dbgp
xdebug.remote_host = $REMOTE_HOST ; IDE-Environments IP, from vagrant box.
EOF

cat <<EOF >> /etc/php/7.1/apache2/conf.d/30-custom.ini
error_reporting = E_ALL
display_errors = On
variables_order = "EGPCS"
memory_limit = 32M
EOF

echo -e "\n--- Enabling mod-rewrite ---\n"
a2enmod rewrite

echo -e "\n--- Setting web root to public directory ---\n"
rm -rf /var/www
ln -fs /vagrant /var/www

cat > /etc/apache2/sites-available/localhost.conf <<EOF
<VirtualHost *:80>
    DocumentRoot /var/www/web
     <Directory /var/www/web>
        Options Indexes FollowSymLinks MultiViews
        AllowOverride All
        Order allow,deny
        allow from all
    </Directory>
    ErrorLog \${APACHE_LOG_DIR}/error.log
    CustomLog \${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
EOF

a2ensite localhost

a2dissite 000-default

echo -e "\n--- Restarting Apache ---\n"
service apache2 restart

echo -e "\n--- Installing Composer for PHP package management ---\n"
curl --silent https://getcomposer.org/installer | php > /dev/null 2>&1
mv composer.phar /usr/local/bin/composer

cd /vagrant

sudo -u vagrant composer global require fxp/composer-asset-plugin:1.2.2
sudo -u vagrant composer install

echo -e "\n--- Add github token for composer ---\n"
sudo -u vagrant composer config -g github-oauth.github.com $GITHUB_TOKEN

echo -e "\n--- run application migration ---\n"
cd /vagrant
php ./yii migrate --interactive=0 > /dev/null 2>&1