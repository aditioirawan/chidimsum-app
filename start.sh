#!/usr/bin/env bash

# Pastikan folder log dan cache bisa ditulis (Bypass permission denied)
chmod -R 777 /var/www/html/storage /var/www/html/bootstrap/cache

# Bersihkan cache konfigurasi
php artisan config:clear
php artisan cache:clear

# Migrasi otomatis ke database Neon.tech
php artisan migrate --force

# Jalankan server
apache2-foreground