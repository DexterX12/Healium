FROM php:8.3.11-apache
RUN apt-get update -y && apt-get install -y openssl zip unzip git 
RUN docker-php-ext-install pdo_mysql
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
COPY . /var/www/html
# Ensure the public .htaccess is in the public folder (Apache will serve from public)
COPY ./public/.htaccess /var/www/html/public/.htaccess
WORKDIR /var/www/html

# Serve Laravel from the public directory at container root
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Update Apache configuration to use new document root and directory
RUN sed -ri -e "s!/var/www/html!${APACHE_DOCUMENT_ROOT}!g" /etc/apache2/sites-available/*.conf \
 && sed -ri -e "s!<Directory /var/www/html>!<Directory ${APACHE_DOCUMENT_ROOT}>!g" /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist

#RUN php artisan key:generate
RUN php artisan storage:link
RUN chmod -R 777 storage

# Ensure Apache user owns files
RUN chown -R www-data:www-data /var/www/html

RUN a2enmod rewrite
RUN service apache2 restart
