FROM php:8.2-apache

RUN apt-get update && apt-get install -y libpq-dev libpng-dev libjpeg-dev libfreetype6-dev zip unzip git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_pgsql pgsql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/html
COPY . .

# Install dependensi
RUN composer install --no-dev --optimize-autoloader --no-scripts

# PERBAIKAN Izin Folder (PENTING)
# Berikan izin penuh pada storage dan cache agar tidak terjadi "Permission Denied"
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 777 /var/www/html/storage /var/www/html/bootstrap/cache

RUN a2enmod rewrite
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Tambahkan start.sh yang sudah kita buat
RUN chmod +x start.sh
EXPOSE 80

CMD ["./start.sh"]