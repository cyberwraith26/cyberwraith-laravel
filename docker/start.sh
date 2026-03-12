#!/bin/bash

php artisan package:discover --ansi

# Cache config, routes and views
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations
php artisan migrate --force

# Start Apache in foreground
apache2-foreground
