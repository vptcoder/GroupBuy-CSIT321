#! /bin/bash
echo -----INSTALL: COMPOSER PACKAGES-----
composer require laravel/installer
composer require stripe/stripe-php
composer install

echo -----INSTALL: NPM PACKAGES-----
npm install

# npm install laravel-mix@latest --save-dev
# npm install vue-router
# npm install vue
# npm install vuex
# npm install vue-waypoint
# npm install vue-owl-carousel
# npm install @stripe/stripe-js --save-dev
# npm install webpack

echo -----MIGRATE: DB-----
php artisan migrate
php artisan passport:install

echo -----BUILD: APPLICATION-----
npm run dev

echo -----DEPLOY: APPLICATION-----
php artisan config:cache
php artisan route:cache
php artisan serve
