# Stage 1: Build PHP dependencies
FROM composer:2.6 AS build

WORKDIR /app

# Copy composer files and install dependencies
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader

# Stage 2: Drupal + Apache for Cloud Run
FROM drupal:11-php8.3-apache

WORKDIR /var/www/html

# Copy Drupal files
COPY . /var/www/html

# Copy vendor directory from build stage
COPY --from=build /app/vendor /var/www/html/vendor

# Cloud Run port
ENV PORT=8080

# Enable Apache modules and configure DocumentRoot
RUN a2enmod rewrite headers \
    && sed -i "s|/var/www/html|/var/www/html/web|g" /etc/apache2/sites-available/000-default.conf \
    && sed -i "s/80/${PORT}/g" /etc/apache2/ports.conf \
    && echo "Listen 0.0.0.0:${PORT}" >> /etc/apache2/ports.conf \
    && chown -R www-data:www-data /var/www/html

EXPOSE 8080

CMD ["apache2-foreground"]
