# Use PHP 8.3 with Apache
FROM php:8.3-apache

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libwebp-dev \
    libzip-dev \
    libxml2-dev \
    libonig-dev \
    zip unzip git curl vim nano pkg-config \
    && rm -rf /var/lib/apt/lists/*

# Configure and install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) gd zip pdo pdo_mysql mbstring xml opcache

# Enable Apache rewrite module
RUN a2enmod rewrite

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy Drupal files
COPY . /var/www/html/

# Install Composer dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Ensure settings.php exists
RUN if [ ! -f web/sites/default/settings.php ]; then \
        cp web/sites/default/default.settings.php web/sites/default/settings.php; \
    fi

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && find web/sites/default/files -type d -exec chmod 775 {} \; \
    && find web/sites/default/files -type f -exec chmod 664 {} \;

# Set Apache document root to /web
ENV APACHE_DOCUMENT_ROOT /var/www/html/web
EXPOSE 8080

# Update Apache configs for Drupal /web folder
RUN sed -ri -e 's!/var/www/html!/var/www/html/web!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!/var/www/html/web!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Default command
CMD ["apache2-foreground"]
