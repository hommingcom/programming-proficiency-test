FROM php:8.2-alpine

# Essentials
RUN echo "UTC" > /etc/timezone
RUN apk add --no-cache zip unzip curl

RUN apk add --no-cache \
  nodejs \
  npm

# Python needed for npm with vue
RUN apk add --no-cache python3 make g++

# Force workdir for composer and npm install
WORKDIR /programming-proficiency-test

RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN rm -rf composer-setup.php

# Composer install PHP dependencies
COPY composer.* ./
RUN composer install

# Npm install with openssl legacy provider for vue compatibility
COPY package*.json ./
ENV NODE_OPTIONS=--openssl-legacy-provider
RUN npm install

COPY . .

EXPOSE 8080
