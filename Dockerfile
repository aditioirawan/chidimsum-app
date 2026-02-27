FROM php:8.2-apache

# Instalasi ekstensi PHP
RUN apt-get update && apt-get install -y libpq-dev libpng-dev libjpeg-dev libfreetype6-dev zip unzip git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_pgsql pgsql

# Copy Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

# Install dependensi
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Konfigurasi Apache
RUN a2enmod rewrite
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Beri izin eksekusi pada skrip start
RUN chmod +x start.sh

EXPOSE 80

# Jalankan start.sh
CMD ["./start.sh"]