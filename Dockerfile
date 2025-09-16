# Use official PHP 8.3 Apache image
FROM php:8.3-apache

# Arguments
ARG DRUPAL_ROOT=/var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        libwebp-dev \
        libzip-dev \
        zip unzip git curl vim nano pkg-config \
    && docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
        --with-webp \
    && docker-php-ext-install -j$(nproc) gd zip pdo_mysql mbstring exif pcntl bcmath opcache \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Enable Apache rewrite
RUN a2enmod rewrite

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR $DRUPAL_ROOT

# Copy project files
COPY . $DRUPAL_ROOT

# Ensure proper permissions for Drupal
RUN chown -R www-data:www-data $DRUPAL_ROOT \
    && chmod -R 755 $DRUPAL_ROOT

# Install dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction || true

# Expose Apache port
EXPOSE 8080

# Set Apache to listen on Cloud Run's port
ENV APACHE_DOCUMENT_ROOT=${DRUPAL_ROOT}/web
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Healthcheck
HEALTHCHECK --interval=30s --timeout=5s CMD curl -f http://localhost:8080/ || exit 1

# Start Apache
CMD ["apache2-foreground"]
