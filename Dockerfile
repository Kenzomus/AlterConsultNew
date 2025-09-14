# Base image with PHP and Apache
FROM php:8.3-apache

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install required system dependencies
RUN apt-get update && apt-get install -y \
    git unzip libicu-dev libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install intl pdo pdo_mysql gd mbstring opcache

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set workdir
WORKDIR /var/www/html

# Copy project files (excluding vendor/ because composer will handle it)
COPY composer.json composer.lock ./
COPY web ./web

# Install PHP dependencies inside the container
RUN COMPOSER_ALLOW_SUPERUSER=1 composer install --no-dev --optimize-autoloader

# Ensure correct permissions
RUN chown -R www-data:www-data /var/www/html

# Expose Apache port
EXPOSE 8080

# Override default Apache config for Drupal
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf
