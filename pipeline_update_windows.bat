@echo off
echo -----INSTALL: COMPOSER PACKAGES-----
@REM call composer require laravel/installer
@REM call composer require stripe/stripe-php
call composer install

echo -----INSTALL: NPM PACKAGES-----
call npm install

@REM call npm install laravel-mix@latest --save-dev
@REM call npm install vue-router
@REM call npm install vue
@REM call npm install vuex
@REM call npm install vue-waypoint
@REM call npm install vue-owl-carousel
@REM call npm install @stripe/stripe-js --save-dev
@REM call npm install webpack

echo -----MIGRATE: DB-----
call php artisan migrate
call php artisan passport:install

echo -----BUILD: APPLICATION-----
call npm run dev

echo -----DEPLOY: APPLICATION-----
call php artisan config:cache
call php artisan route:cache
call php artisan serve --host 0.0.0.0 --port 80
