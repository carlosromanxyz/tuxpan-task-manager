# Usamos la imagen oficial de PHP-FPM
FROM php:8.3-fpm

# Instalamos extensiones de PHP necesarias para Laravel
RUN docker-php-ext-install pdo pdo_mysql

# Instalamos Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establecemos el directorio de trabajo
WORKDIR /var/www

# Copiamos el código fuente de la aplicación Laravel al contenedor
COPY . /var/www

# Instalamos las dependencias de la aplicación con Composer
RUN composer install --no-dev --optimize-autoloader

# Asignamos permisos adecuados a los directorios de Laravel
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
