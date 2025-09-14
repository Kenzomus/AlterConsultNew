# Stage 1: Build with Composer
FROM php:8.3-cli AS builder

# Install system deps and PHP extensions needed for composer install
RUN apt-get update && apt-get install -y \
    git unzip libicu-dev libpq-dev libpng-dev libjpeg-dev libfreetype6-dev libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd intl pdo pdo_mysql zip opcache \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy composer files
COPY composer.json composer.lock ./

# Install PHP dependencies into vendor/
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Copy rest of project
COPY . .

# Stage 2: Runtime with Apache
FROM php:8.3-apache

# Install required extensions again for runtime
RUN apt-get update && apt-get install -y \
    libicu-dev libpq-dev libpng-dev libjpeg-dev libfreetype6-dev libzip-dev unzip git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd intl pdo pdo_mysql zip opcache \
    && rm -rf /var/lib/apt/lists/*

RUN a2enmod rewrite

WORKDIR /var/www/html

# Copy everything from builder (including vendor/)
COPY --from=builder /app /var/www/html

# Apache docroot to web/
ENV APACHE_DOCUMENT_ROOT=/var/www/html/web
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

EXPOSE 8080
CMD ["apache2-foreground"]
