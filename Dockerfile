# Stage 1: Build Drupal dependencies
FROM composer:2 AS build

WORKDIR /app

# Copy composer files
COPY composer.json composer.lock ./

# Install dependencies (no dev packages for production)
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# Copy the full project (web/ vendor/ modules/ themes/)
COPY . .

# Stage 2: Final image
FROM php:8.3-apache

WORKDIR /var/www/html

# Enable Apache modules
RUN a2enmod rewrite headers expires

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git unzip libpng-dev libjpeg-dev libfreetype6-dev libonig-dev libxml2-dev libzip-dev \
    mariadb-client libicu-dev g++ \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql gd opcache intl zip \
    && rm -rf /var/lib/apt/lists/*

# Copy built Drupal under /var/www/html/web (CORRECT)
COPY --from=build /app/web /var/www/html
COPY --from=build /app/vendor /var/www/html/vendor

# PHP config
RUN { \
    echo "memory_limit=512M"; \
    echo "upload_max_filesize=64M"; \
    echo "post_max_size=64M"; \
    echo "max_execution_time=300"; \
} > /usr/local/etc/php/conf.d/drupal.ini

# File permissions
RUN chown -R www-data:www-data /var/www/html && \
    find /var/www/html -type d -exec chmod 755 {} \; && \
    find /var/www/html -type f -exec chmod 644 {} \;

# Writable files directory
RUN mkdir -p sites/default/files && chown -R www-data:www-data sites/default/files

# Cloud Run uses port 8080
RUN sed -i 's/80/8080/g' /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf
EXPOSE 8080

VOLUME ["/cloudsql"]

CMD ["apache2-foreground"]
