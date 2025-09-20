#!/bin/bash

# Default to 8080 if PORT is not set
PORT=${PORT:-8080}

# Rewrite Apache config to use dynamic port
echo "Listen ${PORT}" > /etc/apache2/ports.conf
echo "<VirtualHost *:${PORT}>
    DocumentRoot /var/www/html/web
    <Directory /var/www/html/web>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>" > /etc/apache2/sites-available/000-default.conf

# Start Apache
exec apache2-foreground