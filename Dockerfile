FROM php:8.2-apache

RUN apt-get update && apt-get install -y libpq-dev libpng-dev libjpeg-dev libfreetype6-dev zip unzip git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_pgsql pgsql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/html
COPY . .

# Install dependensi
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Tambahkan baris ini untuk memastikan folder storage bisa diakses
RUN chmod -R 777 /var/www/html/storage /var/www/html/bootstrap/cache

RUN a2enmod rewrite
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

RUN chmod +x start.sh
EXPOSE 80

CMD ["./start.sh"]