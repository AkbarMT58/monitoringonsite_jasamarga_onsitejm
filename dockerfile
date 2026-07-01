FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip \
    nano \
    curl \
    libonig-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    cron \
    git \
    procps \
    tzdata \
    nginx \
    supervisor \
    && docker-php-ext-install pdo pdo_mysql mbstring \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install zip \
    && docker-php-ext-configure opcache --enable-opcache \
    && docker-php-ext-install opcache \
    && rm -rf /var/lib/apt/lists/*

# COMPOSER
RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin \
    --filename=composer \
    && chmod +x /usr/local/bin/composer

WORKDIR /var/www/monitoringonsite_jasamarga_onsitejm

# COPY DEPENDENCY FILES FIRST
COPY composer.json composer.lock ./

RUN composer install \
    --no-dev \
    --no-scripts \
    --no-scripts \
    --no-interaction 


COPY . .


# Expose the port Artisan serve uses
EXPOSE 8000


# Laravel runtime directories
RUN mkdir -p storage/logs \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    bootstrap/cache

# PERMISSIONS

RUN chown -R www-data:www-data /var/www/monitoringonsite_jasamarga_onsitejm \
    && chmod -R 755 storage

# Add cron job line to crontab
RUN echo "* * * * * cd /var/www/monitoringonsite_jasamarga_onsitejm.git && php artisan schedule:run >> /dev/null 2>&1" | crontab -

# Entrypoint script to start PHP-FPM and Cron
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["php-fpm"]