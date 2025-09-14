# ------------------------------------------------------
# Stage 1: Build (Composer)
# ------------------------------------------------------
FROM composer:2 AS build

WORKDIR /app

# Copy composer files
COPY composer.json composer.lock ./

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Copy Drupal source code
COPY . .

# ------------------------------------------------------
# Stage 2: Runtime (Apache + PHP)
# ------------------------------------------------------
FROM php:8.3-apache AS runtime

# Install required PHP extensions
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo pdo_mysql \
    && rm -rf /var/lib/apt/lists/*

# Enable Apache mod_rewrite
RUN a2enmod rewrite

WORKDIR /var/www/html

# Copy Drupal code from build stage
COPY --from=build /app /var/www/html

# Set file permissions (for Cloud Run, www-data can write)
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Expose the port Cloud Run expects
EXPOSE 8080

# Use the official PHP entrypoint
CMD ["apache2-foreground"]
