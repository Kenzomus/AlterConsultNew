# -------------------------
# Stage 1: Build PHP dependencies with Composer
# -------------------------
FROM composer:2 AS builder

WORKDIR /app

# Copy only composer files first (better cache)
COPY composer.json composer.lock ./

# Install dependencies (no dev for production)
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Copy rest of Drupal code
COPY . /app


# -------------------------
# Stage 2: Apache + PHP Runtime
# -------------------------
FROM php:8.3-apache

# Install required PHP extensions
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libwebp-dev \
    zip unzip git pkg-config \
 && docker-php-ext-configure gd --with-jpeg --with-freetype --with-webp \
 && docker-php-ext-install gd zip pdo pdo_mysql mbstring exif pcntl bcmath opcache \
 && apt-get clean && rm -rf /var/lib/apt/lists/*

# Enable Apache rewrite
RUN a2enmod rewrite

# Configure Apache to listen on $PORT (required by Cloud Run)
RUN sed -i 's/80/${PORT}/g' /etc/apache2/sites-available/000-default.conf \
 && sed -i 's/80/${PORT}/g' /etc/apache2/ports.conf

# Copy Drupal code from builder stage
WORKDIR /var/www/html
COPY --from=builder /app /var/www/html

# Ensure correct permissions
RUN chown -R www-data:www-data sites modules themes

# Environment variables
ENV PORT=8080
EXPOSE 8080

# Apache will run as default CMD from base image
