# Base image: PHP 8.3 with Apache
FROM php:8.3-apache

# Set working directory to Apache web root
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql gd zip opcache \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Enable Apache modules required by Drupal
RUN a2enmod rewrite headers

# Copy only the web directory as the Apache document root
COPY web/ /var/www/html/

# Allow .htaccess overrides (Drupal needs this for clean URLs & access rules)
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Set correct permissions for Drupal
RUN chown -R www-data:www-data /var/www/html \
    && find /var/www/html -type d -exec chmod 755 {} \; \
    && find /var/www/html -type f -exec chmod 644 {} \;

# Expose the Cloud Run expected port
EXPOSE 8080

# Run Apache in the foreground
CMD ["apache2-foreground"]
