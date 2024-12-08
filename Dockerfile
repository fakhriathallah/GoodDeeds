FROM php:8.2-apache

# Instal dependensi tambahan jika diperlukan
RUN apt-get update && apt-get install -y libssl-dev

# Salin semua file proyek ke container
COPY . /var/www/html

# Berikan izin untuk folder
RUN chmod -R 755 /var/www/html

# Instal dependensi Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader
