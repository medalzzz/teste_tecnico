FROM php:8.2-apache

# php extensions install
# RUN docker-php-ext-install pdo pdo_mysql

# enable apache htaccess rewrite
RUN a2enmod rewrite

# update apache configuration to point to laravel public dir
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf \
    && sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/default-ssl.conf