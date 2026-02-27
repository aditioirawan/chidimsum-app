#!/usr/bin/env bash

# Paksa Laravel untuk menggunakan /tmp untuk menyimpan cache view (bypass permission denied)
export VIEW_COMPILED_PATH=/tmp

# Pastikan cache yang lama dihapus agar tidak konflik
rm -rf storage/framework/views/*.php

# Bersihkan cache Laravel
php artisan config:clear
php artisan cache:clear

# Migrasi database
php artisan migrate --force

# Jalankan Apache
apache2-foreground