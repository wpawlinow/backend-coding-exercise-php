#!/bin/sh
set -e
cd /app \
  && composer install \
	&& php-fpm &> /dev/null \
	&& nginx -g 'daemon off;'
