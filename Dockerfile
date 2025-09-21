# Stage 1: Base PHP image
FROM php:8.3-apache

# Set working directory
WORKDIR /var/www/html

# Update system and install required packages and PHP extensions
RUN apt-get update && apt-get install -y \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        libzip-dev \
        zip unzip git curl \
        && docker-php-ext-configure gd --with-freetype --with-jpeg \
        && docker-php-ext-install gd zip pdo_mysql mbstring intl opcache \
        && apt-get clean \
        && rm -rf /var/lib/apt/lists/*

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install Composer globally
COPY --from=composer:2.8 /usr/bin/composer /usr/bin/composer

# Copy Drupal code
COPY . .

# Ensure proper permissions
RUN chown -R www-data:www-data /var/www/html

# Expose the port that Cloud Run expects
ENV PORT 8080
EXPOSE 8080

# Start Apache in foreground
CMD ["apache2-foreground"]
