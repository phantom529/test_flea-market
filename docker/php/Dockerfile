FROM php:8.2-fpm

COPY php.ini /usr/local/etc/php/

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libzip-dev \
    default-mysql-client \
 && docker-php-ext-install pdo_mysql zip

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

