FROM php:8-alpine

# Essentials
RUN echo "UTC" > /etc/timezone
RUN apk add --no-cache zip unzip curl

RUN apk add --no-cache \
  nodejs \
  npm
# El primer comando me descarga este instalador || Que se llamará composer-setup.php // Después lo correremos
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php  
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN rm -rf composer-setup.php

EXPOSE 8080
EXPOSE 3000
