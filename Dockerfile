# Stage 1: Base PHP 8.3 Apache image
FROM php:8.3-apache AS base

WORKDIR /var/www/html

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    wget \
    && docker-php-ext-install pdo pdo_mysql gd zip opcache \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Enable Apache modules
RUN a2enmod rewrite headers

# Copy Drupal files
COPY . /var/www/html

# Set Drupal permissions
RUN chown -R www-data:www-data /var/www/html \
    && find /var/www/html -type d -exec chmod 755 {} \; \
    && find /var/www/html -type f -exec chmod 644 {} \;

# PHP configuration
RUN echo "memory_limit=512M\nupload_max_filesize=100M\npost_max_size=100M\nmax_execution_time=300\n" > /usr/local/etc/php/conf.d/drupal.ini \
    && echo "opcache.enable=1\nopcache.memory_consumption=128\nopcache.interned_strings_buffer=16\nopcache.max_accelerated_files=10000\nopcache.revalidate_freq=0\nopcache.validate_timestamps=0\n" >> /usr/local/etc/php/conf.d/opcache.ini

# Cloud Run port
ENV PORT 8080
RUN sed -i "s/Listen 80/Listen ${PORT}/g" /etc/apache2/ports.conf \
    && sed -i "s/<VirtualHost \*:80>/<VirtualHost *:${PORT}>/g" /etc/apache2/sites-enabled/000-default.conf

EXPOSE 8080

# Stage 2: Add Cloud SQL Auth Proxy
FROM base

# Download Cloud SQL Auth Proxy
RUN wget https://dl.google.com/cloudsql/cloud_sql_proxy.linux.amd64 -O /cloud_sql_proxy \
    && chmod +x /cloud_sql_proxy

# Environment variables for Cloud SQL
ENV CLOUDSQL_CONNECTION_NAME="PROJECT_ID:REGION:INSTANCE_ID"
ENV DB_USER="DB_USER"
ENV DB_PASS="DB_PASSWORD"
ENV DB_NAME="DB_NAME"

# Run both Cloud SQL Proxy and Apache
CMD /cloud_sql_proxy -instances=$CLOUDSQL_CONNECTION_NAME=tcp:3306 & apache2-foreground
