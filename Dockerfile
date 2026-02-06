FROM php:8.3-apache

ENV APACHE_DOCUMENT_ROOT=/var/www/html/web
ENV PORT=8080

# Install deps
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libonig-dev mariadb-client \
    && docker-php-ext-install zip pdo_mysql gd \
    && rm -rf /var/lib/apt/lists/*

# Enable rewrite
RUN a2enmod rewrite

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

RUN composer install --no-dev --optimize-autoloader --no-interaction
RUN chown -R www-data:www-data /var/www/html

# Apache runtime config (Cloud Run safe)
RUN sed -i "s#/var/www/html#${APACHE_DOCUMENT_ROOT}#g" /etc/apache2/sites-available/000-default.conf \
 && echo "ServerName localhost" >> /etc/apache2/apache2.conf

EXPOSE 8080

# 👇 THIS IS THE KEY DIFFERENCE
CMD sed -i "s/Listen 80/Listen ${PORT}/" /etc/apache2/ports.conf \
 && sed -i "s/:80>/:${PORT}>/" /etc/apache2/sites-available/000-default.conf \
 && apachectl -D FOREGROUND
