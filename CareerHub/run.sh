#!/bin/sh
echo "Running script from $(pwd)"
ls -al
php artisan session:table
php artisan migrate:fresh --seed
php artisan serve --host=0.0.0.0 --port=8000
