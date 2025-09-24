# Use official PHP 8.3 Apache image
FROM php:8.3-apache

# Set environment variables for Cloud Run
ENV APACHE_DOCUMENT_ROOT=/var/www/html/web
ENV PORT=8080

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libwebp-dev \
    libzip-dev \
    libxml2-dev \
    pkg-config \
    libonig-dev \
    zip unzip git curl vim nano \
    && rm -rf /var/lib/apt/lists/*

# Configure and install PHP extensions required by Drupal
RUN docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
        --with-webp \
    && docker-php-ext-install -j$(nproc) \
        gd zip pdo pdo_mysql mbstring xml opcache

# Enable Apache rewrite module
RUN a2enmod rewrite

# Update Apache configs for Drupal /web folder
RUN sed -ri -e 's!/var/www/html!/var/www/html/web!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!/var/www/html/web!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy Drupal code
COPY . /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && find /var/www/html/web/sites/default/files -type d -exec chmod 775 {} \; \
    && find /var/www/html/web/sites/default/files -type f -exec chmod 664 {} \;

# Install PHP dependencies with Composer
RUN php -d memory_limit=-1 /usr/local/bin/composer install --no-dev --no-scripts --no-progress --prefer-dist --optimize-autoloader

# Expose Cloud Run port
EXPOSE 8080

# Default command for Cloud Run
CMD ["apache2-foreground"]
