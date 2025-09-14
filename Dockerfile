# ------------------------------------------------------
# Stage 1: Build stage (composer + dependencies)
# ------------------------------------------------------
FROM php:8.3-cli AS build

# Set working directory
WORKDIR /app

# Install system dependencies and PHP extensions needed for Drupal packages
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo pdo_mysql mbstring exif pcntl bcmath opcache \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Copy composer files separately for caching
COPY composer.json composer.lock ./

# Install PHP dependencies (no dev)
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Copy the rest of the Drupal code
COPY . .

# ------------------------------------------------------
# Stage 2: Runtime (Apache + PHP)
# ------------------------------------------------------
FROM php:8.3-apache AS runtime

WORKDIR /var/www/html

# Install runtime PHP extensions
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo pdo_mysql mbstring exif pcntl bcmath opcache \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Copy Drupal code + vendor from build stage
COPY --from=build /app /var/www/html

# Set Apache environment
ENV PORT 8080
EXPOSE 8080

# Enable mod_rewrite
RUN a2enmod rewrite

# Set permissions
RUN chown -R www-data:www-data /var/www/html/sites /var/www/html/modules /var/www/html/themes

# Run Apache in foreground
CMD ["apache2-foreground"]
