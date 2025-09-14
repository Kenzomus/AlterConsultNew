# ------------------------------------------------------
# Stage 1: Build (Composer)
# ------------------------------------------------------
FROM composer:2 AS build

WORKDIR /app

# Copy only composer files for faster builds
COPY composer.json composer.lock ./

# Install PHP dependencies (ignore GD for build)
RUN composer install --no-dev --optimize-autoloader --no-interaction --ignore-platform-req=ext-gd

# Copy the rest of the application code
COPY . .

# ------------------------------------------------------
# Stage 2: Runtime (Apache + PHP)
# ------------------------------------------------------
FROM php:8.3-apache AS runtime

# Set working directory
WORKDIR /var/www/html

# Install required PHP extensions
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

# Copy Drupal code and vendor from build stage
COPY --from=build /app /var/www/html

# Set file permissions (optional, adjust for your setup)
RUN chown -R www-data:www-data /var/www/html \
    && find /var/www/html -type d -exec chmod 755 {} \; \
    && find /var/www/html -type f -exec chmod 644 {} \;

# Expose port 8080 (Cloud Run expects this)
ENV PORT=8080
EXPOSE 8080

# Start Apache in foreground
CMD ["apache2-foreground"]
