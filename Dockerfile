# Use official PHP + Apache image
FROM php:8.3-apache

WORKDIR /var/www/html

# Enable Apache rewrite
RUN a2enmod rewrite

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libonig-dev mariadb-client \
    && docker-php-ext-install zip pdo_mysql gd \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy Drupal project files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Expose Cloud Run port
EXPOSE 8080

# Run Apache in foreground
CMD ["apache2-foreground"]
