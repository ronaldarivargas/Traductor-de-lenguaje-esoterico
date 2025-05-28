# Imagen de PHP con Apache
FROM php:8.2-apache

# Instalar extensiones necesarias (pdo_pgsql) para conectar con PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Habilitar mod_rewrite para URL amigables que se puede usar posteriormente
RUN a2enmod rewrite

# Copia el proyecto al contenedor
COPY . /var/www/html/

# Establece permisos adecuados (opcional pero útil)
RUN chown -R www-data:www-data /var/www/html

# Exponer el puerto 80
EXPOSE 80