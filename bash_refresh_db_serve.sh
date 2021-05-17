#! /bin/bash
php artisan migrate:fresh --seed
php artisan passport:install
npm run dev
# php artisan config:clear
php artisan config:cache
php artisan route:cache
php artisan serve