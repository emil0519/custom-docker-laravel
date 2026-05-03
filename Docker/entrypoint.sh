#!/bin/sh
set -e

if [ ! -f "vendor/autoload.php" ]; then
    composer install --no-progress --no-interaction
fi

if [ ! -f ".env" ]; then
    echo "Creating .env file"
    cp .env.example .env
else
    echo ".env file exists."
fi

role=${CONTAINER_ROLE:-app}

if [ "$role" = "app" ]; then
    php artisan key:generate --force
    php artisan migrate --force
    php artisan cache:clear
    php artisan config:clear
    php artisan route:clear

    exec php artisan serve --host=0.0.0.0 --port="$port"

elif [ "$role" = "queue" ]; then
    echo "Running queue worker"

    exec php artisan queue:work --verbose --tries=3

else
    echo "Unknown container role: $role"
    exit 1
fi

