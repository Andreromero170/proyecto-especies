# Usar la imagen base oficial de PHP con Apache
FROM php:8.2-apache

# Instalar extensiones necesarias
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    zip \
    && docker-php-ext-install zip pdo_mysql

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Habilitar módulos de Apache necesarios
RUN a2enmod rewrite

# Copiar configuración de Apache
COPY apache-config.conf /etc/apache2/sites-available/000-default.conf

# Establecer directorio de trabajo
WORKDIR /var/www/html

# Copiar proyecto Laravel
COPY . /var/www/html/

# Asegurar que existe el archivo .htaccess en public
RUN echo '<IfModule mod_rewrite.c>\n\
    <IfModule mod_negotiation.c>\n\
        Options -MultiViews -Indexes\n\
    </IfModule>\n\
    RewriteEngine On\n\
    RewriteCond %{REQUEST_FILENAME} !-d\n\
    RewriteCond %{REQUEST_FILENAME} !-f\n\
    RewriteRule ^ index.php [L]\n\
</IfModule>' > /var/www/html/public/.htaccess

# Establecer permisos adecuados
RUN chown -R www-data:www-data /var/www/html

# Crear directorios necesarios y establecer permisos
RUN mkdir -p /var/www/html/storage/logs \
    /var/www/html/storage/app \
    /var/www/html/storage/framework/cache \
    /var/www/html/storage/framework/sessions \
    /var/www/html/storage/framework/views \
    /var/www/html/bootstrap/cache \
    && chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Instalar dependencias y optimizar
RUN composer install --no-dev --optimize-autoloader

# Iniciar Apache y configurar Laravel
CMD php artisan key:generate --force && \
    php artisan storage:link && \
    apache2-foreground
