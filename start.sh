#!/bin/sh

echo "Clearing config..."
php artisan config:clear
php artisan cache:clear

echo "Running fresh migration..."
php artisan migrate:fresh --force

echo "Starting Apache..."
apache2-foreground