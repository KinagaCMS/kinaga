FROM php:7-apache
RUN apt-get update && a2enmod rewrite && apt-get install -y --no-install-recommends locales locales-all libonig-dev libfreetype6-dev libjpeg-dev libpng-dev libc-client-dev libkrb5-dev msmtp imagemagick libmagickwand-dev && pecl install imagick && PHP_OPENSSL=yes docker-php-ext-configure imap --with-kerberos --with-imap-ssl && docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ && docker-php-ext-enable imagick && docker-php-ext-install intl imap exif gd && usermod -u 1000 www-data && groupmod -g 1000 www-data && docker-php-source delete && apt-get clean -y && rm -rf /var/lib/apt/lists/*
