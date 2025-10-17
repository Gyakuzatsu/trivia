# Imagen base con PHP + Apache
FROM php:8.2-apache

# Copia todo tu proyecto al servidor web del contenedor
COPY . /var/www/html/

# Instala la extensión mysqli para conectar a MySQL
RUN docker-php-ext-install mysqli

# Habilita reescritura (por si usas rutas limpias)
RUN a2enmod rewrite

# Expone el puerto 80 (para la web)
EXPOSE 80

# Comando para iniciar Apache
CMD ["apache2-foreground"]