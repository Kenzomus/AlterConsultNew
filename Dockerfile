# ------------------------------------------------------------
# Base image: Official PHP 8.3 with Apache
# ------------------------------------------------------------
FROM php:8.3-apache

# ------------------------------------------------------------
# 1. Install system and PHP dependencies
# ------------------------------------------------------------
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
    libxslt-dev \
    libssl-dev \
    libcurl4-openssl-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        gd intl pdo_mysql opcache zip bcmath dom xml tokenizer ctype session simplexml xsl \
    && docker-php-ext-enable opcache \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# ------------------------------------------------------------
# 2. Enable Apache rewrite (Drupal clean URLs)
# ------------------------------------------------------------
RUN a2enmod rewrite

# ------------------------------------------------------------
# 3. Set working directory
# ------------------------------------------------------------
WORKDIR /var/www/html

# ------------------------------------------------------------
# 4. Copy Composer and install dependencies
# ------------------------------------------------------------
COPY --from=composer:2.8 /usr/bin/composer /usr/bin/composer

# Allow Composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV COMPOSER_MEMORY_LIMIT=-1

# Copy only dependency files first (for Docker caching)
COPY composer.json composer.lock ./

# Install PHP dependencies (no dev, verbose log)
RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader \
    -vvv 2>&1 | tee /tmp/composer-install.log || (cat /tmp/composer-install.log && false)

# ------------------------------------------------------------
# 5. Copy the rest of the project files
# ------------------------------------------------------------
COPY . .

# ------------------------------------------------------------
# 6. Fix file and folder permissions (important for Drupal)
# ------------------------------------------------------------
RUN chown -R www-data:www-data /var/www/html /var/log/apache2 /var/run/apache2 \
    && find /var/www/html -type d -exec chmod 755 {} \; \
    && find /var/www/html -type f -exec chmod 644 {} \;

# ------------------------------------------------------------
# 7. Configure Apache for Cloud Run
# ------------------------------------------------------------
ENV PORT=8080
EXPOSE 8080

# Update Apache to listen on Cloud Run port
RUN sed -i 's/80/8080/g' /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

# ------------------------------------------------------------
# 8. Set recommended PHP settings for production
# ------------------------------------------------------------
RUN echo "memory_limit=512M" > /usr/local/etc/php/conf.d/memory-limit.ini \
    && echo "upload_max_filesize=50M" > /usr/local/etc/php/conf.d/uploads.ini \
    && echo "post_max_size=50M" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "max_execution_time=300" >> /usr/local/etc/php/conf.d/uploads.ini

# ------------------------------------------------------------
# 9. Run Apache in the foreground
# ------------------------------------------------------------
CMD ["apache2-foreground"]
