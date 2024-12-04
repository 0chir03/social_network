FROM php:8.2-fpm

RUN apt update -q;
RUN apt update && apt install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git;

RUN apt install -q -y libpq-dev;
RUN docker-php-ext-install pdo_pgsql pgsql;


RUN docker-php-ext-configure gd --with-freetype --with-jpeg && docker-php-ext-install gd;

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug;
