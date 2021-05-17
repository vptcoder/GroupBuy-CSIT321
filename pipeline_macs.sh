#! /bin/bash
echo -----COMPOSER PACKAGES-----
composer require laravel/installer
composer require stripe/stripe-php
composer install

echo -----NPM PACKAGES-----
npm install

npm install laravel-mix@latest --save-dev
npm install vue-router
npm install vue
npm install vuex
npm install vue-waypoint
npm install vue-owl-carousel
npm install @stripe/stripe-js --save-dev
npm install webpack

echo -----.ENV FILE-----
cp -f .env.example .env
php artisan key:generate

echo -----DB MIGRATION-----
php artisan migrate:fresh --seed
php artisan passport:install

echo -----BUILD-----
npm run dev

echo -----DEPLOY-----
php artisan config:cache
php artisan route:cache
php artisan serve
