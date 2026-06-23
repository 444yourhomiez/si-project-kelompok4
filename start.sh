#!/bin/sh

# Pastikan direktori storage ada dan bisa ditulis
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/framework/cache/data
mkdir -p storage/logs
chmod -R 777 storage bootstrap/cache

# Clear cache
php artisan config:clear

# Start PHP-FPM
php-fpm -D

# Start Nginx
nginx -g "daemon off;"