# Base image: PHP 8.3 with Apache
FROM php:8.3-apache

# Install system dependencies and PHP extensions for Drupal
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libwebp-dev \
    libxpm-dev \
    libzip-dev \
    unzip git curl vim nano pkg-config \
    libicu-dev \
    && docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
        --with-webp \
        --with-xpm \
    && docker-php-ext-install -j$(nproc) gd zip pdo_mysql intl opcache \
    && docker-php-ext-enable gd zip pdo_mysql intl opcache \
    && rm -rf /var/lib/apt/lists/*

# Enable Apache rewrite (needed for Drupal pretty URLs)
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy project files into container
COPY . /var/www/html

# Set correct permissions
RUN chown -R www-data:www-data /var/www/html

# Expose port 8080 for Cloud Run
EXPOSE 8080

# Update Apache to listen on Cloud Run's PORT env variable
RUN sed -i 's/80/${PORT}/g' /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf

# Start Apache in foreground
CMD ["apache2-foreground"]
