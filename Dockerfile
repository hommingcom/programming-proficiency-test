FROM php:8.2-alpine

# Essentials
RUN echo "UTC" > /etc/timezone

RUN apk add --no-cache \
  nodejs \
  npm

RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN rm -rf composer-setup.php

EXPOSE 8080
