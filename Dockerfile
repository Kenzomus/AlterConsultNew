FROM php:8.3-apache

WORKDIR /var/www/html

# ----------------------------------------------------------
# 1. Install system dependencies for GD, ZIP & others
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
# 2. Install PHP extensions (IMPORTANT: correct GD flags)
# ----------------------------------------------------------
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) \
        gd zip pdo pdo_mysql mbstring xml opcache

# Enable mod_rewrite
RUN a2enmod rewrite

# ----------------------------------------------------------
# 3. Install Composer
# ----------------------------------------------------------
RUN curl -sS https://getcomposer.org/installer \
    | php -- --install-dir=/usr/local/bin --filename=composer

# ----------------------------------------------------------
# 4. Copy project
# ----------------------------------------------------------
COPY . /var/www/html/

# ----------------------------------------------------------
# 5. Install composer deps *after* GD exists
# ----------------------------------------------------------
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# ----------------------------------------------------------
# 6. Prepare Drupal files
# ----------------------------------------------------------
RUN if [ ! -f web/sites/default/settings.php ]; then \
      cp web/sites/default/default.settings.php web/sites/default/settings.php; \
    fi

RUN mkdir -p web/sites/default/files && \
    chown -R www-data:www-data web/sites/default && \
    find web/sites/default/files -type d -exec chmod 775 {} \; && \
    find web/sites/default/files -type f -exec chmod 664 {} \;

# ----------------------------------------------------------
# 7. Apache DocumentRoot = /web
# ----------------------------------------------------------
ENV APACHE_DOCUMENT_ROOT /var/www/html/web

RUN sed -ri -e 's!/var/www/html!/var/www/html/web!g' \
      /etc/apache2/sites-available/*.conf && \
    sed -ri -e 's!/var/www/!/var/www/html/web!g' \
      /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

EXPOSE 8080

CMD ["apache2-foreground"]
