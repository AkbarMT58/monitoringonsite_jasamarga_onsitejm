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

WORKDIR /var/www/html

# COPY DEPENDENCY FILES FIRST
COPY composer.json composer.lock ./

# RUN composer install --no-dev --no-autoloader --prefer-dist --no-interaction --no-scripts 

RUN composer install \
    --no-dev \
    --no-scripts \
    --prefer-dist \
    --optimize-autoloader \
    -vvv

# Set permission
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage


    

# PHP CONFIG
COPY docker/php.ini $PHP_INI_DIR/php.ini
COPY docker/www.conf /usr/local/etc/php-fpm.d/www.conf
COPY docker/deploy.conf /etc/nginx/conf.d/default.conf
COPY docker/cronjob /etc/cron.d/cronjob

# COPY APPLICATION CODE
# COPY . .
COPY app app
COPY bootstrap bootstrap
COPY config config
COPY database database
COPY public public
COPY resources resources
COPY routes routes
COPY artisan artisan

RUN php artisan package:discover --ansi

# Laravel runtime directories
RUN mkdir -p storage/logs \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    bootstrap/cache

# PERMISSIONS
RUN chown -R www-data:www-data /var/www/monitoringonsite_jasamarga_onsitejm \
    && chmod -R 775 storage bootstrap/cache


# Add cron job line to crontab
RUN echo "* * * * * cd /var/www/monitoringonsite_jasamarga_onsitejm.git && php artisan schedule:run >> /dev/null 2>&1" | crontab -

# Entrypoint script to start PHP-FPM and Cron
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["php-fpm"]