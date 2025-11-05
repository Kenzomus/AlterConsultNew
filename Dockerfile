# Stage 1: Build Drupal dependencies
FROM composer:2 AS build

# Set working directory
WORKDIR /app

# Copy composer files
COPY composer.json composer.lock ./

# Install dependencies (no dev packages for production)
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# Copy project files (excluding ignored files via .dockerignore)
COPY . .

# Stage 2: Final image with Apache and PHP 8.3
FROM php:8.3-apache

# Set working directory
WORKDIR /var/www/html

# Enable required Apache modules
RUN a2enmod rewrite headers expires

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git unzip libpng-dev libjpeg-dev libfreetype6-dev libonig-dev libxml2-dev libzip-dev \
    mariadb-client libicu-dev g++ \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql gd opcache intl zip \
    && rm -rf /var/lib/apt/lists/*

# Copy built Drupal files from composer stage
COPY --from=build /app /var/www/html

# Set recommended PHP configurations
RUN { \
    echo "memory_limit=512M"; \
    echo "upload_max_filesize=64M"; \
    echo "post_max_size=64M"; \
    echo "max_execution_time=300"; \
} > /usr/local/etc/php/conf.d/drupal.ini

# Set file permissions for Apache
RUN chown -R www-data:www-data /var/www/html && \
    find /var/www/html -type d -exec chmod 755 {} \; && \
    find /var/www/html -type f -exec chmod 644 {} \;

# Ensure Drupal sites directory is writable
RUN mkdir -p sites/default/files && chown -R www-data:www-data sites/default/files

# Expose HTTP port
EXPOSE 8080

# Change Apache port to 8080 (Cloud Run requirement)
RUN sed -i 's/80/8080/g' /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf

# Mount Cloud SQL Unix socket
VOLUME ["/cloudsql"]

# Set environment variables (override in Cloud Run)
ENV DB_CONNECTION_NAME=alter-consult-464302:us-central1:drupal-db \
    DB_USER=drupaluser \
    DB_PASSWORD=yourpassword \
    DB_NAME=drupal \
    DRUPAL_SITE_NAME="Alter Consult Drupal 11"

# Set entrypoint (use Apache)
CMD ["apache2-foreground"]
