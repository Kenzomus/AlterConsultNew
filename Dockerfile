# Use official PHP with Apache
FROM php:8.3-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git unzip zip libicu-dev libxml2-dev libzip-dev \
    libpng-dev libjpeg-dev libfreetype6-dev libonig-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd intl pdo_mysql opcache zip \
    && docker-php-ext-enable opcache

# Enable Apache rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy all project files
COPY . .

# Install Composer
COPY --from=composer:2.8 /usr/bin/composer /usr/bin/composer
ENV COMPOSER_MEMORY_LIMIT=-1

# Install dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# Fix permissions
RUN chown -R www-data:www-data /var/www/html /var/log/apache2 /var/run/apache2

# Set Cloud Run port
ENV PORT=8080
EXPOSE 8080

# Make Apache listen on Cloud Run port
RUN sed -i 's/80/8080/g' /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

# Run Apache in foreground
CMD ["apache2-foreground"]
