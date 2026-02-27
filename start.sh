#!/usr/bin/env bash

# 1. Pindahkan lokasi cache ke /tmp agar tidak butuh izin tulis di storage
export VIEW_COMPILED_PATH=/tmp

# 2. Bersihkan cache konfigurasi
php artisan config:clear
php artisan cache:clear

# 3. Jalankan migrasi agar tabel (products, sessions, dll) tercipta di Neon.tech
php artisan migrate --force

# 4. Jalankan Apache
apache2-foreground