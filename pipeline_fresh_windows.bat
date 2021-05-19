@echo off
echo -----DB FILE CREATION-----
type nul > database/database.sqlite

echo -----COMPOSER PACKAGES-----
call composer require laravel/installer
call composer require stripe/stripe-php
call composer install

echo -----NPM PACKAGES-----
call npm install

call npm install laravel-mix@latest --save-dev
call npm install vue-router
call npm install vue
call npm install vuex
call npm install vue-waypoint
call npm install vue-owl-carousel
call npm install @stripe/stripe-js --save-dev
call npm install webpack

echo -----.ENV FILE-----
copy .env.example .env /y
call php artisan key:generate

echo -----DB MIGRATION-----
call php artisan migrate:fresh --seed
call php artisan passport:install

echo -----BUILD-----
call npm run dev

echo -----DEPLOY-----
call php artisan config:cache
call php artisan route:cache
call php artisan serve --host 0.0.0.0 --port 80
