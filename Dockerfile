# Stage 1: Build dependencies with Composer
FROM composer:2 AS vendor

WORKDIR /app

# Copy only composer files first (better cache)
COPY composer.json composer.lock ./

# Install PHP dependencies (no dev dependencies for production)
RUN composer install --no-dev --no-scripts --no-progress --prefer-dist --optimize-autoloader

# Stage 2: Final Drupal + Apache image
FROM drupal:11-php8.3-apache

# Install required system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev libwebp-dev libzip-dev zip unzip git curl vim nano pkg-config \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) gd zip \
    && rm -rf /var/lib/apt/lists/*

# Copy Drupal project files
WORKDIR /var/www/html
COPY . /var/www/html

# Copy vendor from build stage
COPY --from=vendor /app/vendor /var/www/html/vendor

# Fix permissions
RUN chown -R www-data:www-data /var/www/html

# Cloud Run requires the app to listen on $PORT (default 8080)
ENV PORT=8080

# Update Apache config to use $PORT
RUN sed -i "s/80/\${PORT}/g" /etc/apache2/sites-available/000-default.conf \
    && sed -i "s/80/\${PORT}/g" /etc/apache2/ports.conf

EXPOSE 8080

# Start Apache in foreground
CMD ["apache2-foreground"]
