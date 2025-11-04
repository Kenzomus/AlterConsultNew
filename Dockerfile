# -----------------------------------------------------------
# 1. Base image
# -----------------------------------------------------------
FROM php:8.3-apache

# -----------------------------------------------------------
# 2. Install dependencies
# -----------------------------------------------------------
RUN apt-get update && apt-get install -y \
    git unzip zip libicu-dev libxml2-dev libzip-dev libpng-dev \
    libjpeg-dev libfreetype6-dev libonig-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd intl pdo_mysql opcache zip \
    && docker-php-ext-enable opcache \
    && a2enmod rewrite headers expires env dir mime \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# -----------------------------------------------------------
# 3. Set working directory
# -----------------------------------------------------------
WORKDIR /var/www/html

# -----------------------------------------------------------
# 4. Copy application code
# -----------------------------------------------------------
COPY . .

# -----------------------------------------------------------
# 5. Install Composer dependencies
# -----------------------------------------------------------
COPY --from=composer:2.8 /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV COMPOSER_MEMORY_LIMIT=-1

RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# -----------------------------------------------------------
# 6. Configure Apache for Cloud Run
# -----------------------------------------------------------
# Replace port 80 with 8080
RUN sed -i 's/80/8080/g' /etc/apache2/ports.conf

# Create a dedicated vhost for Drupal with correct permissions
RUN echo '<VirtualHost *:8080>\n\
    DocumentRoot /var/www/html/web\n\
    <Directory /var/www/html/web>\n\
        Options FollowSymLinks\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
    ErrorLog /var/log/apache2/error.log\n\
    CustomLog /var/log/apache2/access.log combined\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

# -----------------------------------------------------------
# 7. Permissions
# -----------------------------------------------------------
RUN chown -R www-data:www-data /var/www/html && \
    find /var/www/html -type d -exec chmod 755 {} \; && \
    find /var/www/html -type f -exec chmod 644 {} \;

# -----------------------------------------------------------
# 8. Environment for Cloud Run
# -----------------------------------------------------------
ENV PORT=8080
EXPOSE 8080

# -----------------------------------------------------------
# 9. Start Apache
# -----------------------------------------------------------
CMD ["apache2-foreground"]
