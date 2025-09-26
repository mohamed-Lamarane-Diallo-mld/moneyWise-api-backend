# Utiliser PHP 8.2 avec Apache
FROM php:8.2-apache

# Installer les extensions nécessaires pour Laravel
RUN apt-get update && apt-get install -y \
    git unzip curl libpng-dev libonig-dev libxml2-dev zip \
    && docker-php-ext-install pdo_pgsql mbstring exif pcntl bcmath gd \
    && a2enmod rewrite

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier le projet Laravel entier
COPY . .

COPY docker/000-default.conf /etc/apache2/sites-available/000-default.conf
# Copier le fichier de configuration Apache

# Installer Composer
COPY --from=composer:2.5 /usr/bin/composer /usr/bin/composer

# Installer les dépendances PHP
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Permissions pour storage/cache
RUN chown -R www-data:www-data storage bootstrap/cache public

# Exposer le port Render
ENV PORT=10000
EXPOSE 10000

# Apache démarre automatiquement
CMD ["apache2-foreground"]
