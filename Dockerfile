FROM php:8.3-apache

WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    pkg-config \
    && docker-php-ext-configure gd \
        --with-jpeg \
        --with-freetype \
    && docker-php-ext-install gd zip pdo pdo_mysql mbstring exif pcntl bcmath opcache \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Enable Apache rewrite module
RUN a2enmod rewrite

# Copy composer files for caching
COPY composer.json composer.lock ./

# Install Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && composer install --no-dev --optimize-autoloader --no-interaction \
    && rm composer-setup.php

# Copy Drupal code
COPY . .

# Set permissions
RUN chown -R www-data:www-data sites modules themes

# Cloud Run port
ENV PORT 8080
EXPOSE 8080

CMD ["apache2-foreground"]
