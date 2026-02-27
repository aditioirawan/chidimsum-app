#!/bin/sh

echo "Running Laravel migrations..."
php artisan migrate --force

echo "Starting Apache..."
apache2-foreground