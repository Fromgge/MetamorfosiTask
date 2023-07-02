FROM php:8.1-apache

RUN apt-get update && \
    apt-get install libpq-dev -y && \
    apt-get install -y git && \
    docker-php-ext-install pdo_pgsql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer