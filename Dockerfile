# ------------------------------------------------------
# Stage 1: Composer dependencies
# ------------------------------------------------------
FROM composer:2 AS builder

WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# ------------------------------------------------------
# Stage 2: Drupal runtime with Apache + PHP
# ------------------------------------------------------
FROM php:8.3-apache

# Set working directory
WORKDIR /var/www/html

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev libwebp-dev \
    libzip-dev zip unzip git curl vim nano pkg-config \
    libonig-dev libicu-dev libxml2-dev default-mysql-client \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) \
        gd zip pdo_mysql mbstring exif pcntl bcmath opcache intl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Enable Apache modules
RUN a2enmod rewrite headers

# Update Apache config to serve from /web
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/web|' /etc/apache2/sites-available/000-default.conf \
 && echo "<Directory /var/www/html/web>\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>" >> /etc/apache2/apache2.conf

# Copy project files
COPY . .

# Copy vendor from builder stage
COPY --from=builder /app/vendor ./vendor

# Fix permissions
RUN chown -R www-data:www-data /var/www/html \
    && find /var/www/html -type d -exec chmod 755 {} \; \
    && find /var/www/html -type f -exec chmod 644 {} \;

# PHP settings for Drupal
RUN echo "memory_limit=512M\n\
upload_max_filesize=64M\n\
post_max_size=64M\n\
max_execution_time=300\n\
opcache.enable=1\n\
opcache.memory_consumption=256\n\
opcache.max_accelerated_files=20000\n\
opcache.revalidate_freq=0" > /usr/local/etc/php/conf.d/drupal.ini

# Add entrypoint to fix Cloud Run $PORT
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

EXPOSE 8080
CMD ["docker-entrypoint.sh"]
