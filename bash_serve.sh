#! /bin/bash
npm run dev
php artisan config:clear
php artisan config:cache
php artisan serve