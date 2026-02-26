FROM php:8.2-apache

# Install semua kebutuhan sistem
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev libpq-dev zip unzip git

# Install ekstensi PHP yang dibutuhkan Laravel & PostgreSQL
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql pdo_pgsql pgsql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

# Install dependencies (folder vendor akan dibuat di sini)
RUN composer install --no-dev --optimize-autoloader

# Setting izin folder agar bisa diakses Apache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN a2enmod rewrite

# Setup Apache ke folder public
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# PERINTAH TAMBAHAN: Bersihkan cache agar Laravel membaca environment baru
RUN php artisan config:clear
RUN php artisan cache:clear

EXPOSE 80