FROM php:8.2-alpine

# Essentials
RUN echo "UTC" > /etc/timezone

RUN apk add --no-cache \
  libressl \
  autoconf \
  gcc \
  g++ \
  libtool \
  make \
  git \
  zip \
  unzip \
  curl \
  python3 \
  nodejs \
  npm

RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN rm -rf composer-setup.php

# Copy package.json to get all of the new's dependencies
COPY package.json .

# Install new dependencies
RUN npm i

EXPOSE 8080
