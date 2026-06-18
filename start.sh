#!/bin/sh

# Clear cache
php artisan config:clear

# Start PHP-FPM
php-fpm -D

# Start Nginx
nginx -g "daemon off;"