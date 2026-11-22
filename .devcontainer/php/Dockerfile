FROM php:8.3-apache

RUN docker-php-ext-install mysqli pdo_mysql \
    && a2enmod headers \
    && printf '%s\\n' \
       'DirectoryIndex login.php index.php index.html' \
       '<Directory /var/www/html>' \
       '    Options -Indexes +FollowSymLinks' \
       '    AllowOverride All' \
       '    Require all granted' \
       '</Directory>' \
       > /etc/apache2/conf-available/edusched-webapp.conf \
    && a2enconf edusched-webapp

WORKDIR /var/www/html
EXPOSE 80
