#!/usr/bin/env bash
# Bersihkan cache agar tidak nyangkut
php artisan config:clear
php artisan cache:clear

# PERINTAH SAKTI: Ini yang akan buat tabel di Neon.tech
php artisan migrate --force

# Nyalakan server
apache2-foreground