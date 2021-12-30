#!/bin/sh

DIRECTORIO=/var/www/vendor

if [ -d "$DIRECTORIO" ]
then
  echo true
else
   cd /var/www/ && composer install
fi