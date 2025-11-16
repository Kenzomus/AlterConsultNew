# Stage 1: Build Drupal dependencies
FROM composer:2.6 AS build

WORKDIR /app

# Copy composer files
COPY composer.json composer.lock ./

# Install production dependencies only
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# Copy the full project (web/ vendor/ modules/ themes/)
COPY . .

# Stage 2: Final image
FROM php:8.3-apache

WORKDIR /var/www/html

# Enable Apache modules
RUN a2enmod rewrite headers expires

# Install system dependencies for Drupal + PHP extensions
RUN apt-get update && apt-get install -y \
    git unzip libpng-dev libjpeg-dev libfreetype6-dev libonig-dev libxml2-dev libzip-dev \
    mariadb-client libicu-dev g++ default-mysql-client \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql gd opcache intl zip \
    && rm -rf /var/lib/apt/lists/*

# Copy built Drupal code from build stage
COPY --from=build /app/web /var/www/html
COPY --from=build /app/vendor /var/www/html/vendor

# PHP configuration
RUN { \
    echo "memory_limit=512M"; \
    echo "upload_max_filesize=64M"; \
    echo "post_max_size=64M"; \
    echo "max_execution_time=300"; \
} > /usr/local/etc/php/conf.d/drupal.ini

# Set permissions
RUN chown -R www-data:www-data /var/www/html && \
    find /var/www/html -type d -exec chmod 755 {} \; && \
    find /var/www/html -type f -exec chmod 644 {} \;

# Writable files directory
RUN mkdir -p sites/default/files && chown -R www-data:www-data sites/default/files

# Expose port 8080 for Cloud Run
EXPOSE 8080

# Cloud SQL Unix socket directory (default for Cloud Run)
VOLUME ["/cloudsql"]

# Entrypoint: Apache foreground
CMD ["apache2-foreground"]
