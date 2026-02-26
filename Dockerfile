FROM php:8.2-apache

# Install dependencies yang dibutuhkan Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Set folder kerja ke web root
WORKDIR /var/www/html

# Copy semua file project ke server
COPY . .

# Set permission biar Laravel bisa nulis di folder storage
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Aktifkan rewrite module biar route Laravel jalan
RUN a2enmod rewrite

# Ganti DocumentRoot Apache ke folder public Laravel
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

EXPOSE 80