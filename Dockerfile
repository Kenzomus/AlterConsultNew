# Use official PHP with Apache
FROM php:8.3-apache

# -------------------------------------------------------------------
# 1. Install system and PHP dependencies
# -------------------------------------------------------------------
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libicu-dev \
    libxml2-dev \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd intl pdo_mysql opcache zip \
    && docker-php-ext-enable opcache \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# -------------------------------------------------------------------
# 2. Enable Apache rewrite (needed for Drupal clean URLs)
# -------------------------------------------------------------------
RUN a2enmod rewrite

# -------------------------------------------------------------------
# 3. Set working directory
# -------------------------------------------------------------------
WORKDIR /var/www/html

# -------------------------------------------------------------------
# 4. Copy project files
# -------------------------------------------------------------------
COPY . .

# -------------------------------------------------------------------
# 5. Install Composer
# -------------------------------------------------------------------
COPY --from=composer:2.8 /usr/bin/composer /usr/bin/composer

# Allow Composer to run as root and increase memory limit
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV COMPOSER_MEMORY_LIMIT=-1

# -------------------------------------------------------------------
# 6. Install PHP dependencies with better error visibility
# -------------------------------------------------------------------
RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction \
    --prefer-dist \
    --verbose || (cat /tmp/composer.log || true)

# -------------------------------------------------------------------
# 7. Fix file permissions (required for Drupal runtime)
# -------------------------------------------------------------------
RUN chown -R www-data:www-data /var/www/html /var/log/apache2 /var/run/apache2 \
    && find /var/www/html -type d -exec chmod 755 {} \; \
    && find /var/www/html -type f -exec chmod 644 {} \;

# -------------------------------------------------------------------
# 8. Set Cloud Run port
# -------------------------------------------------------------------
ENV PORT=8080
EXPOSE 8080

# Update Apache configuration to listen on Cloud Run port
RUN sed -i 's/80/8080/g' /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

# -------------------------------------------------------------------
# 9. Run Apache in the foreground
# -------------------------------------------------------------------
CMD ["apache2-foreground"]
