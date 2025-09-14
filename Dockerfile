# Stage 1: Build environment
FROM php:8.3-cli AS build

# Set working directory
WORKDIR /app

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    libonig-dev \
    libxml2-dev \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Configure and install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo pdo_mysql mbstring exif pcntl bcmath opcache

# Copy composer files first for caching
COPY composer.json composer.lock ./

# Install PHP dependencies (no dev)
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Copy Drupal source code
COPY . .

# Stage 2: Runtime
FROM php:8.3-apache

WORKDIR /var/www/html

# Copy built application from build stage
COPY --from=build /app /var/www/html

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Expose port 8080
EXPOSE 8080

# Start Apache
CMD ["apache2-foreground"]
