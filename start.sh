#!/usr/bin/env bash

# Paksa Laravel ke folder /tmp agar tidak ada akses ke storage yang dikunci
export VIEW_COMPILED_PATH=/tmp

# Bersihkan cache
php artisan config:clear
php artisan cache:clear

# Migrasi tabel session dan database
php artisan migrate --force

# Jalankan Apache
apache2-foreground