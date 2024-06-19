FROM php:8.1

# Install Composer
ENV COMPOSER_VERSION 2.1.5

RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libpq-dev\
    libxml2-dev\
    iputils-ping\
    libzip-dev\
    && docker-php-ext-configure gd --with-freetype --with-jpeg\
    && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql pdo_pgsql

RUN docker-php-ext-install soap  && docker-php-ext-enable soap

RUN docker-php-ext-install zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version=$COMPOSER_VERSION

WORKDIR /var/www/html

# Copy composer.json and composer.lock
COPY composer.json composer.lock ./

# Install dependencies
RUN composer install --no-scripts --no-autoloader

COPY . .

RUN composer dump-autoload

RUN chown -R www-data:www-data \
    /var/www/html/storage \
    /var/www/html/bootstrap/cache


CMD php artisan serve --host=0.0.0.0 --port=8001