    composer global require laravel/installer
    composer require stripe/stripe-php
    REM composer update --no-scripts
    composer install
    npm install

    npm install laravel-mix@latest --save-dev
    npm install vue-router
    npm install vue
    npm install vuex
    npm install vue-waypoint
    npm install vue-owl-carousel
    npm install --save-dev @stripe/stripe-js
    npm install webpack

    REM .env.template -> .env
    copy .env.example .env /y
    php artisan key:generate

    php artisan migrate:fresh --seed

    php artisan passport:install

    npm run dev
    
    php artisan config:cache
    php artisan route:cache
    php artisan serve --host 0.0.0.0 --port 443
