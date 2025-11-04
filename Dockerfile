# ===========================================================
# 🐘 Drupal on PHP 8.3 + Apache for Google Cloud Run
# ===========================================================

# 1️⃣ Base image
FROM php:8.3-apache

# -----------------------------------------------------------
# 2️⃣ Install system and PHP dependencies
# -----------------------------------------------------------
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libicu-dev \
    libxml2-dev \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" gd intl pdo_mysql opcache zip \
    && docker-php-ext-enable opcache \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# -----------------------------------------------------------
# 3️⃣ Apache configuration for Drupal
# -----------------------------------------------------------
# Set document root to Drupal’s “web” folder (Drupal 10+ structure)
ENV APACHE_DOCUMENT_ROOT=/var/www/html/web

# Update default Apache config
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf && \
    sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# Enable rewrite and headers modules for Drupal clean URLs and caching
RUN a2enmod rewrite headers

# Add Drupal-friendly directory permissions
RUN echo '<Directory /var/www/html/web>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' > /etc/apache2/conf-available/drupal.conf \
    && a2enconf drupal

# -----------------------------------------------------------
# 4️⃣ Set working directory
# -----------------------------------------------------------
WORKDIR /var/www/html

# -----------------------------------------------------------
# 5️⃣ Copy project files
# -----------------------------------------------------------
COPY . .

# -----------------------------------------------------------
# 6️⃣ Install Composer
# -----------------------------------------------------------
COPY --from=composer:2.8 /usr/bin/composer /usr/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER=1
ENV COMPOSER_MEMORY_LIMIT=-1

# -----------------------------------------------------------
# 7️⃣ Install PHP dependencies (Drupal + modules)
# -----------------------------------------------------------
RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction \
    --prefer-dist \
    --verbose || (cat /tmp/composer.log || true)

# -----------------------------------------------------------
# 8️⃣ Fix file permissions for Apache and Drupal
# -----------------------------------------------------------
RUN chown -R www-data:www-data /var/www/html /var/log/apache2 /var/run/apache2 \
    && find /var/www/html -type d -exec chmod 755 {} \; \
    && find /var/www/html -type f -exec chmod 644 {} \; \
    && chmod -R 775 /var/www/html/sites/default/files || true

# -----------------------------------------------------------
# 9️⃣ Set Cloud Run port and expose
# -----------------------------------------------------------
ENV PORT=8080
EXPOSE 8080

# Update Apache to listen on Cloud Run port
RUN sed -i 's/80/8080/g' /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

# -----------------------------------------------------------
# 🔟 Start Apache in the foreground
# -----------------------------------------------------------
CMD ["apache2-foreground"]
