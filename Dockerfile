# Stage 1: Build vendor with Composer
FROM composer:2 AS vendor

WORKDIR /app

# Copy composer files
COPY composer.json composer.lock ./

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Stage 2: Final Drupal + Apache image
FROM php:8.3-apache

# Set working directory
WORKDIR /var/www/html

# Install system dependencies & PHP extensions
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev libwebp-dev libzip-dev zip unzip git curl vim nano pkg-config \
    libonig-dev libicu-dev libxml2-dev default-mysql-client \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) gd zip pdo_mysql mbstring exif pcntl bcmath opcache intl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Enable Apache modules required for Drupal
RUN a2enmod rewrite headers

# Copy Drupal files
COPY . /var/www/html

# Copy vendor directory from build stage
COPY --from=vendor /app/vendor /var/www/html/vendor

# Fix permissions
RUN chown -R www-data:www-data /var/www/html

# Cloud Run requires the container to listen on $PORT
ENV PORT=8080

# Set Apache DocumentRoot to /var/www/html/web for Composer-based Drupal
RUN sed -i "s/80/\${PORT}/g" /etc/apache2/ports.conf \
    && sed -i "s|/var/www/html|/var/www/html/web|g" /etc/apache2/sites-available/000-default.conf

EXPOSE 8080

# PHP recommended settings for Drupal
RUN { \
      echo "memory_limit=512M"; \
      echo "upload_max_filesize=64M"; \
      echo "post_max_size=64M"; \
      echo "max_execution_time=300"; \
      echo "opcache.enable=1"; \
      echo "opcache.memory_consumption=256"; \
      echo "opcache.max_accelerated_files=20000"; \
      echo "opcache.revalidate_freq=0"; \
    } > /usr/local/etc/php/conf.d/drupal.ini

# Start Apache
CMD ["apache2-foreground"]
