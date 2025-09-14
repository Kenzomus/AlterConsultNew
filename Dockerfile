# ------------------------------------------------------
# Single-stage Dockerfile for Drupal 11 on Cloud Run
# ------------------------------------------------------
FROM php:8.3-apache

# Set working directory
WORKDIR /var/www/html

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-configure gd \
        --with-freetype=/usr/include/ \
        --with-jpeg=/usr/include/ \
    && docker-php-ext-install gd zip pdo pdo_mysql mbstring exif pcntl bcmath opcache \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Enable Apache rewrite module
RUN a2enmod rewrite

# Copy composer files first (for caching)
COPY composer.json composer.lock ./

# Install PHP dependencies
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && composer install --no-dev --optimize-autoloader --no-interaction \
    && rm composer-setup.php

# Copy the rest of Drupal code
COPY . .

# Set permissions for Drupal
RUN chown -R www-data:www-data sites modules themes

# Expose port 8080 for Cloud Run
ENV PORT 8080
EXPOSE 8080

# Start Apache in foreground
CMD ["apache2-foreground"]
