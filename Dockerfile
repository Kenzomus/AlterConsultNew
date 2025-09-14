# ------------------------------------------------------
# Stage 1: Build vendor dependencies with Composer
# ------------------------------------------------------
FROM php:8.3-cli AS vendor

WORKDIR /app

# Install tools needed for composer
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip \
    && rm -rf /var/lib/apt/lists/*

# Install Composer (inside the php:8.3-cli container)
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && rm composer-setup.php

# Copy composer files and install dependencies
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Copy everything else (needed for custom modules/themes)
COPY . .

# ------------------------------------------------------
# Stage 2: Runtime (Apache + PHP)
# ------------------------------------------------------
FROM php:8.3-apache AS runtime

WORKDIR /var/www/html

# Install required PHP extensions for Drupal
RUN apt-get update && apt-get install -y \
    libzip-dev libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd mysqli pdo pdo_mysql zip opcache \
    && rm -rf /var/lib/apt/lists/*

# Enable Apache rewrite
RUN a2enmod rewrite

# Copy Drupal project from vendor stage
COPY --from=vendor /app /var/www/html

# Set proper permissions for Drupal (simplified)
RUN chown -R www-data:www-data /var/www/html/web/sites /var/www/html/web/modules /var/www/html/web/themes

# Environment variables (Cloud Run sets these dynamically)
ENV PORT=8080
EXPOSE 8080

CMD ["apache2-foreground"]
