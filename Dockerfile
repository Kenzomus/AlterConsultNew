FROM php:8.3-apache

# Install required system libraries
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libwebp-dev \
    libzip-dev \
    libxml2-dev \
    pkg-config \
    libonig-dev \        # <--- Oniguruma required for mbstring
    zip unzip git curl vim nano \
    && rm -rf /var/lib/apt/lists/*

# Configure and install PHP extensions
RUN docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
        --with-webp \
    && docker-php-ext-install -j$(nproc) \
        gd zip pdo pdo_mysql mbstring xml opcache

# Enable Apache rewrite module
RUN a2enmod rewrite

# Copy Drupal files
COPY . /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Set Apache document root
ENV APACHE_DOCUMENT_ROOT /var/www/html/web
EXPOSE 8080

# Update Apache configs for Drupal /web folder
RUN sed -ri -e 's!/var/www/html!/var/www/html/web!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!/var/www/html/web!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
