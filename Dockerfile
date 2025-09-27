# Use official PHP Apache base image
FROM php:8.3-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git unzip libpng-dev libjpeg-dev libfreetype6-dev libzip-dev libonig-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo pdo_mysql opcache \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Enable Apache rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy composer first (for caching)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy only composer files first
COPY composer.json composer.lock ./

# Install PHP dependencies inside container
RUN composer install --no-dev --optimize-autoloader

# Now copy Drupal code
COPY . .

# Fix permissions for Drupal
RUN chown -R www-data:www-data /var/www/html \
    && mkdir -p /var/www/html/web/sites/default/files \
    && chown -R www-data:www-data /var/www/html/web/sites/default/files \
    && find /var/www/html/web/sites/default/files -type d -exec chmod 775 {} \; \
    && find /var/www/html/web/sites/default/files -type f -exec chmod 664 {} \;

EXPOSE 80
CMD ["apache2-foreground"]
