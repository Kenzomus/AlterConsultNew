FROM drupal:11-php8.3-apache

# Install dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev libwebp-dev libzip-dev zip unzip git curl vim nano pkg-config \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) gd zip \
    && rm -rf /var/lib/apt/lists/*

# Copy Drupal files
COPY . /var/www/html

# Set working directory
WORKDIR /var/www/html

# Fix permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Set Cloud Run port
ENV PORT 8080
EXPOSE 8080

# Use env variable to start Apache
CMD sed -i "s/80/${PORT}/g" /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf \
    && apache2-foreground
