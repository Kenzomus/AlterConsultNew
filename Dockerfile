# ------------------------------------------------------
# Stage 1: Build stage (composer + dependencies)
# ------------------------------------------------------
FROM php:8.3-cli AS build

WORKDIR /app

# Install system dependencies and GD prerequisites
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-configure gd \
        --with-freetype=/usr/include/ \
        --with-jpeg=/usr/include/ \
    && docker-php-ext-install gd zip pdo pdo_mysql mbstring exif pcntl bcmath opcache \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Copy composer files
COPY composer.json composer.lock ./

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Copy the rest of the code
COPY . .

# ------------------------------------------------------
# Stage 2: Runtime (Apache + PHP)
# ------------------------------------------------------
FROM php:8.3-apache AS runtime

WORKDIR /var/www/html

# Install runtime dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-configure gd \
        --with-freetype=/usr/include/ \
        --with-jpeg=/usr/include/ \
    && docker-php-ext-install gd zip pdo pdo_mysql mbstring exif pcntl bcmath opcache \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Copy built app
COPY --from=build /app /var/www/html

# Apache setup
ENV PORT 8080
EXPOSE 8080
RUN a2enmod rewrite
RUN chown -R www-data:www-data /var/www/html/sites /var/www/html/modules /var/www/html/themes

CMD ["apache2-foreground"]
