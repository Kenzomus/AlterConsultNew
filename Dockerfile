# Install OS packages for PHP extensions
RUN apt-get update && apt-get install -y \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        zip \
        unzip \
        libwebp-dev \
    && docker-php-ext-configure gd \
        --with-jpeg \
        --with-freetype \
        --with-webp \
    && docker-php-ext-install -j$(nproc) gd zip pdo pdo_mysql mbstring exif pcntl bcmath opcache \
    && apt-get clean && rm -rf /var/lib/apt/lists/*
