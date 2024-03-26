# From official php image.
FROM php:8.1-cli-alpine
ARG xdebug_enabled=false

# Create a user group and account under id 1000.
RUN addgroup -g 1000 -S user && adduser -u 1000 -D user -G user
# RUN usermod -aG sudo user

# Install quality-of-life packages.
RUN apk add --no-cache bash curl git nano 

# Installing composer
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN rm -rf composer-setup.php

# Install postgres pdo driver.
# RUN apk add --no-cache postgresql-dev && docker-php-ext-install pdo_pgsql

RUN apk update && \
    apk add bash build-base gcc wget git autoconf libmcrypt-dev libzip-dev zip \
    g++ make openssl-dev openssh-client

# php extensions    
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql
RUN docker-php-ext-install pcntl  
RUN docker-php-ext-install bcmath

# zip ext
RUN apk add --no-cache \
      libzip-dev \
      zip \
    && docker-php-ext-install zip

RUN apk add --no-cache nodejs npm


# Prevent container from exiting early.
CMD ["sleep", "infinity"]