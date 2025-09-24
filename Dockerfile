# Base image
FROM php:8.3-apache

# Set working directory
WORKDIR /var/www/html

# -------------------------------
# 1️⃣ Install system dependencies
# -------------------------------
RUN apt-get update && apt-get install -y --no-install-recommends \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libwebp-dev \
    libzip-dev \
    zip unzip git curl nano pkg-config \
    mariadb-client \
    && rm -rf /var/lib/apt/lists/*

# -------------------------------
# 2️⃣ Install PHP extensions
# -------------------------------
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) gd zip pdo pdo_mysql mbstring xml opcache

# -------------------------------
# 3️⃣ Enable Apache modules
# -------------------------------
RUN a2enmod rewrite headers

# -------------------------------
# 4️⃣ Configure Cloud Run port
# -------------------------------
ENV PORT 8080
RUN sed -i "s/Listen 80/Listen ${PORT}/" /etc/apache2/ports.conf \
    && sed -i "s/<VirtualHost \*:80>/<VirtualHost *:${PORT}>/" /etc/apache2/sites-available/000-default.conf

# -------------------------------
# 5️⃣ Configure document root
# -------------------------------
ENV APACHE_DOCUMENT_ROOT /var/www/html/web
RUN sed -ri -e 's!/var/www/html!/var/www/html/web!g' /etc/apa
