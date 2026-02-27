#!/usr/bin/env bash
export VIEW_COMPILED_PATH=/tmp

php artisan config:clear
php artisan cache:clear

# Migrasi untuk produk dan sesi
php artisan migrate --force

apache2-foreground