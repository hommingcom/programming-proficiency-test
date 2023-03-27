FROM php:8.2-alpine

# Install system dependencies
RUN apk update && apk add --no-cache \
    bash \
    curl \
    git \
    zip \
    unzip \
    libzip-dev \
    nodejs \
    npm \
    oniguruma-dev \
    libffi-dev \
    libressl-dev \
    libtool \
    make \
    autoconf \
    gcc \
    g++ \
    libc-dev \
    pcre-dev \
    re2c

# Install Xdebug 3
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql zip

# Configure PHP and Xdebug
RUN echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_port=9003" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.idekey=PHPSTORM" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "memory_limit=512M" >> /usr/local/etc/php/conf.d/docker-php-memlimit.ini

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set the working directory
WORKDIR /programming-proficiency-test

# Copy the application files and directories to the container
COPY . /programming-proficiency-test

# Create a new user and group
ARG UID=1000
ARG GID=1000
RUN addgroup -g $GID -S appgroup \
    && adduser -u $UID -S appuser -G appgroup \
    && chown -R appuser:appgroup /programming-proficiency-test

# Set the user for the container
USER appuser
