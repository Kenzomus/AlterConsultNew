# ------------------------------------------------------
# Stage 1: Build Stage (Composer + Dependencies)
# ------------------------------------------------------
FROM php:8.3-cli AS build

WORKDIR /app

# Install system dependencies for PHP extensions
RUN apt-get update && apt-get install -y \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        libzip-dev \
        libonig-dev \
        libicu-dev \
        zip \
        unzip \
        git \
        curl \
        pkg-config \
        unzip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Configure and install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo pdo_mysql mbstring exif pcntl bcmath opcache intl

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy composer files and install PHP dependencies
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction

# ------------------------------------------------------
# Stage 2: Runtime (Apache + PHP)
# ------------------------------------------------------
FROM php:8.3-apache AS runtime

WORKDIR /var/www/html

# Install system dependencies for runtime (if needed)
RUN apt-get update && apt-get install -y \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        libzip-dev \
        libonig-dev \
        libicu-dev \
        zip \
        unzip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Configure and install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo pdo_mysql mbstring exif pcntl bcmath opcache intl

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy built vendor from build stage
COPY --from=build /app/vendor /var/www/html/vendor

# Copy Drupal source code
COPY . .

# Set permissions for Drupal
RUN chown -R www-data:www-data /var/www/html/web/sites

# Cloud Run listens on PORT env variable
ENV PORT 8080
EXPOSE 8080

# Apache foreground
CMD ["apache2-foreground"]
