# Use PHP 8.3 with Apache
FROM php:8.3-apache

# Enable required Apache modules
RUN a2enmod rewrite expires headers

# Install dependencies
RUN apt-get update && apt-get install -y \
    git unzip libpng-dev libjpeg-dev libfreetype6-dev libonig-dev libxml2-dev mariadb-client \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql mbstring exif pcntl bcmath opcache \
    && rm -rf /var/lib/apt/lists/*

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . /var/www/html

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && find /var/www/html -type d -exec chmod 755 {} \; \
    && find /var/www/html -type f -exec chmod 644 {} \;

# ✅ Dynamically configure Apache to listen on $PORT
RUN sed -i "s/Listen 80/Listen \${PORT}/" /etc/apache2/ports.conf \
    && sed -i "s/:80/:${PORT}/g" /etc/apache2/sites-available/000-default.conf

# Environment variables
ENV APACHE_DOCUMENT_ROOT=/var/www/html/web
ENV PORT=8080

# Update Apache config to use Drupal web root
RUN sed -i "s|/var/www/html|${APACHE_DOCUMENT_ROOT}|g" /etc/apache2/sites-available/000-default.conf /etc/apache2/apache2.conf /etc/apache2/sites-available/000-default.conf

# Expose Cloud Run port
EXPOSE 8080

# ✅ Start Apache on Cloud Run's port
CMD ["sh", "-c", "apache2-foreground -DFOREGROUND -k start -e info -DFOREGROUND"]
