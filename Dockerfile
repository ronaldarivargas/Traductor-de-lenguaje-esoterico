# Imagen base con PHP y Apache
FROM php:8.2-apache

# Instalar extensiones para PostgreSQL
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Habilitar mod_rewrite de Apache
RUN a2enmod rewrite

# Copiar archivos del proyecto
COPY . /var/www/html/

# Establecer permisos adecuados
RUN chown -R www-data:www-data /var/www/html

# Puerto que Render espera
ENV PORT=10000
EXPOSE 10000

# Cambiar Apache para usar ese puerto
RUN sed -i "s/80/\${PORT}/g" /etc/apache2/ports.conf /etc/apache2/sites-enabled/000-default.conf

# Comando de inicio
CMD ["apache2-foreground"]
