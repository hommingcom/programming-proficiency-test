FROM php:8-alpine

# Essentials
RUN echo "UTC" > /etc/timezone
RUN apk add --no-cache zip unzip curl

COPY composer.json /var/www/composer.json
COPY composer.lock /var/www/composer.lock

RUN apk add --no-cache \
  nodejs \
  npm

RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN rm -rf composer-setup.php

# RUN cd /var/www/ && composer install

EXPOSE 8080
