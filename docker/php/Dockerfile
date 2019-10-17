FROM php:7.3-fpm

# Install recommended extensions for Symfony
RUN apt update && apt install -y \
        libicu-dev \
        libpq-dev \
    && docker-php-ext-install \
        intl \
        opcache \
        pdo \
        pdo_pgsql \
    && docker-php-ext-enable \
        intl \
        opcache \
        pdo \
        pdo_pgsql

# Permission fix
RUN usermod -u 1000 www-data