# ------------------------------------------------------
# Stage 1: Build - Composer dependencies
# ------------------------------------------------------
FROM composer:2 AS build

WORKDIR /app

# Copy only Composer files first for caching
COPY composer.json composer.lock ./

# Install PHP dependencies (no dev)
RUN composer install --no-dev --optimize-autoloader --no-interaction

# ------------------------------------------------------
# Stage 2: Runtime - PHP + Apache
# ------------------------------------------------------
FROM php:8.3-apache

WORKDIR /var/www/html

# Install OS packages and PHP extensions required by Drupal 11
RUN apt-get update && apt-get install -y \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        libwebp-dev \
        zip \
        unzip \
        git \
        unzip \
        libonig-dev \
    && docker-php-ext-configure gd --with-jpeg --with-freetype --with-webp \
    && docker-php-ext-install -j$(nproc) gd zip pdo pdo_mysql mbstring exif pcntl bcmath opcache \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Enable Apache rewrite module for Drupal
RUN a2enmod rewrite

# Copy Drupal source code
COPY web /var/www/html

# Copy Composer vendor from build stage
COPY --from=build /app/vendor /var/www/html/vendor

# Set permissions for Drupal (adjust UID/GID if necessary)
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Expose Cloud Run port
ENV PORT=8080
EXPOSE 8080

# Run Apache in foreground
CMD ["apache2-foreground"]
