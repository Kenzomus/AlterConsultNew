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

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Enable Apache rewrite module
RUN a2enmod rewrite

# Set working directory to Drupal project root
WORKDIR /var/www/html

# Copy only composer files first to leverage Docker layer caching
COPY composer.json composer.lock /var/www/html/

# Install dependencies before copying full project
RUN composer install --no-dev --optimize-autoloader

# Copy full project into container
COPY . /var/www/html

# Set Apache DocumentRoot to Drupal's /web subdirectory
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/web|g' /etc/apache2/sites-available/000-default.conf \
    && echo '<Directory /var/www/html/web>\nOptions Indexes FollowSymLinks\nAllowOverride All\nRequire all granted\n</Directory>' >> /etc/apache2/apache2.conf

# Set correct permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/web \
    && find /var/www/html/web -type f -exec chmod 644 {} \;

# Ensure installer can write settings and services
RUN chmod -R 775 /var/www/html/web/sites/default \
    && chown -R www-data:www-data /var/www/html/web/sites/default

# Expose port 8080 for Cloud Run
EXPOSE 8080

# Update Apache to listen on Cloud Run's PORT env variable
RUN sed -i 's/80/${PORT}/g' /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf

# Start Apache in foreground
CMD ["apache2-foreground"]