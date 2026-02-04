FROM php:8.3-apache

# ----------------------------------------------------------
# Cloud Run requires PORT=8080
# ----------------------------------------------------------
ENV PORT=8080
ENV APACHE_DOCUMENT_ROOT=/var/www/html/web

WORKDIR /var/www/html

# ----------------------------------------------------------
# 1. System dependencies
# ----------------------------------------------------------
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libwebp-dev \
    libzip-dev \
    libxml2-dev \
    libonig-dev \
    zip unzip git curl nano vim pkg-config \
    && rm -rf /var/lib/apt/lists/*

# ----------------------------------------------------------
# 2. PHP extensions
# ----------------------------------------------------------
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) \
        gd zip pdo pdo_mysql mbstring xml opcache

# ----------------------------------------------------------
# 3. Apache configuration (CRITICAL for Cloud Run)
# ----------------------------------------------------------
RUN a2enmod rewrite headers env expires

# Make Apache listen on $PORT instead of 80
RUN sed -i "s/80/${PORT}/g" /etc/apache2/ports.conf \
 && sed -i "s/:80/:${PORT}/g" /etc/apache2/sites-available/000-default.conf

# Update DocumentRoot to /web
RUN sed -ri "s!/var/www/html!${APACHE_DOCUMENT_ROOT}!g" \
      /etc/apache2/sites-available/*.conf \
      /etc/apache2/apache2.conf \
      /etc/apache2/conf-available/*.conf

# Avoid FQDN warning
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# ----------------------------------------------------------
# 4. Install Composer
# ----------------------------------------------------------
RUN curl -sS https://getcomposer.org/installer \
    | php -- --install-dir=/usr/local/bin --filename=composer

# ----------------------------------------------------------
# 5. Copy project files
# ----------------------------------------------------------
COPY . /var/www/html

# ----------------------------------------------------------
# 6. Install Composer dependencies
# ----------------------------------------------------------
RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader

# ----------------------------------------------------------
# 7. Drupal settings & permissions
# ----------------------------------------------------------
RUN if [ ! -f web/sites/default/settings.php ]; then \
      cp web/sites/default/default.settings.php web/sites/default/settings.php; \
    fi

RUN mkdir -p web/sites/default/files && \
    chown -R www-data:www-data /var/www/html && \
    find web/sites/default/files -type d -exec chmod 775 {} \; && \
    find web/sites/default/files -type f -exec chmod 664 {} \;

# ----------------------------------------------------------
# 8. Expose Cloud Run port
# ----------------------------------------------------------
EXPOSE 8080

# ----------------------------------------------------------
# 9. Start Apache
# ----------------------------------------------------------
CMD ["apache2-foreground"]
