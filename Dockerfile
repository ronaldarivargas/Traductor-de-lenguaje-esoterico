# Imagen base de PHP con Apache
FROM php:8.2-apache

# Instalar extensiones necesarias (pdo_pgsql) para conectar con PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Habilitar mod_rewrite para URL amigables (por si lo usas más adelante)
RUN a2enmod rewrite

# Copiar el proyecto al contenedor
COPY . /var/www/html/

# Establecer permisos adecuados (opcional pero útil)
RUN chown -R www-data:www-data /var/www/html

# Exponer el puerto 80
EXPOSE 80
























# Imagen de PHP con Apache
#FROM php:8.2-apache

# Instalar extensiones necesarias (pdo_pgsql) para conectar con PostgreSQL
#RUN apt-get update && apt-get install -y \
#    libpq-dev \
#    && docker-php-ext-install pdo pdo_pgsql

# Habilitar mod_rewrite para URL amigables que se puede usar posteriormente
#RUN a2enmod rewrite

# Copia el proyecto al contenedor
#COPY . /var/www/html/

# Establece permisos adecuados (opcional pero útil)
#RUN chown -R www-data:www-data /var/www/html

# Render usa el puerto 10000
#ENV PORT=10000
#EXPOSE 10000

# Cambia Apache para escuchar en ese puerto
#RUN sed -i 's/80/${PORT}/g' /etc/apache2/ports.conf /etc/apache2/sites-enabled/000-default.conf

# Comando de inicio
#CMD ["apache2-foreground"]# Exponer el puerto 80
#EXPOSE 80