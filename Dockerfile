# Use official PHP 8.3 Apache image
FROM php:8.3-apache

# Set working directory to Drupal root
WORKDIR /var/www/html

# Install system dependencies and PHP extensions
RUN set -ex \
    && apt-get update \
    && apt-get install -y \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        libwebp-dev \
        libzip-dev \
        zip unzip git curl vim nano pkg-config \
        libonig-dev \
        libicu-dev \
        libxml2-dev \
        default-mysql-client \
    \
    # Configure GD with all supported formats
    && docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
        --with-webp \
    \
    # Install PHP extensions
    && docker-php-ext-install -j$(nproc) \
        gd zip pdo_mysql mbstring exif pcntl bcmath opcache intl \
    \
    # Clean up
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Enable Apache modules required for Drupal
RUN a2enmod rewrite headers

# Update Apache config to serve from /web
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/web|' /etc/apache2/sites-available/000-default.conf \
 && echo "<Directory /var/www/html/web>\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>" >> /etc/apache2/apache2.conf

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy project files into container
COPY . .

# Install Composer dependencies
RUN composer install --no-dev --optimize-autoloader

# Set correct permissions for Drupal
RUN chown -R www-data:www-data /var/www/html \
    && find /var/www/html -type d -exec chmod 755 {} \; \
    && find /var/www/html -type f -exec chmod 644 {} \;

# Configure PHP (OPcache + recommended settings for Drupal)
RUN echo "memory_limit=512M\n\
upload_max_filesize=64M\n\
post_max_size=64M\n\
max_execution_time=300\n\
opcache.enable=1\n\
opcache.memory_consumption=256\n\
opcache.max_accelerated_files=20000\n\
opcache.revalidate_freq=0" > /usr/local/etc/php/conf.d/drupal.ini

# Add entrypoint script to inject Cloud Run's $PORT
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Expose Cloud Run port
EXPOSE 8080

# Start Apache via entrypoint
CMD ["docker-entrypoint.sh"]