# Stage 1: Build stage
FROM composer:2 AS build

# Set working directory
WORKDIR /app

# Copy composer files
COPY composer.json composer.lock ./

# Install PHP dependencies (no dev)
RUN composer install --no-dev --optimize-autoloader --no-interaction --ignore-platform-req=ext-gd

# Copy Drupal source code
COPY . .

# Stage 2: Runtime stage (Apache + PHP)
FROM php:8.3-apache AS runtime

# Set working directory
WORKDIR /var/www/html

# Install required OS packages for PHP extensions
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo pdo_mysql mbstring exif pcntl bcmath opcache \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy Drupal code from build stage
COPY --from=build /app /var/www/html

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html

# Expose Cloud Run port
ENV PORT 8080
EXPOSE 8080

# Start Apache in foreground
CMD ["apache2-foreground"]
