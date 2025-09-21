# Use Google’s mirror of the official PHP 8.3 + Apache image (faster + avoids Docker Hub EOF issues)
FROM gcr.io/google-appengine/php:8.3-apache

# Install system dependencies and PHP extensions required by Drupal
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libwebp-dev \
    libzip-dev \
    zip unzip git curl vim nano pkg-config \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) gd zip pdo pdo_mysql \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer (from official image, reliable copy)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set workdir
WORKDIR /var/www/html

# Copy Drupal project files
COPY . /var/www/html

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Fix permissions for Drupal
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Apache will listen on Cloud Run’s required port
ENV PORT=8080
EXPOSE 8080

# Enable Apache Rewrite (needed for Drupal clean URLs)
RUN a2enmod rewrite

# Start Apache
CMD ["apache2-foreground"]
