# Utilise une image PHP officielle avec Apache
FROM php:8.2-apache

# Copie les fichiers de ton projet dans le dossier web de l'image
COPY . /var/www/html/

# Donne les bonnes permissions
RUN chown -R www-data:www-data /var/www/html

# Expose le port 80 pour le web
EXPOSE 80

