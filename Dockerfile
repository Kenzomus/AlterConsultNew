# Use official PHP 8.3 with Apache
FROM php:8.3-apache

# Install dependencies and GD extension
RUN apt-get update && apt-get install -y \
    git unzip libpng-dev libjpeg-dev libfreetype6-dev libwebp-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-enable gd \
    && rm -rf /var/lib/apt/lists/*

# Enable Apache Rewrite (needed for Drupal)
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Install Composer (latest stable)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Expose port 8080 for Cloud Run
EXPOSE 8080

# Apache listens on 8080 for Cloud Run
RUN sed -i 's/80/8080/g' /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf

# Set correct permissions for Drupal
RUN chown -R www-data:www-data /var/www/html

CMD ["apache2-foreground"]
