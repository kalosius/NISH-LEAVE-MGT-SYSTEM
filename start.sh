#!/bin/bash

# Generate app key if not set
if [ -z "$APP_KEY" ]; then
    php artisan key:generate
fi

# Cache config
php artisan config:cache

# Link storage
php artisan storage:link

# Set Apache to listen on PORT (default 10000)
PORT=${PORT:-10000}
sed -i "s/80/$PORT/g" /etc/apache2/ports.conf
sed -i "s/80/$PORT/g" /etc/apache2/sites-available/000-default.conf

# Start Apache
exec apache2-foreground