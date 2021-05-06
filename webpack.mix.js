const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/assets/js/app.js', 'public/js').vue();
mix.js('resources/assets/js/bootstrap.js', 'public/js').vue();

mix.sass('resources/assets/sass/app.scss', 'public/css').vue();

/*
 |--------------------------------------------------------------------------
 | suha - css
 |--------------------------------------------------------------------------
*/
mix.css('resources/css/style.css', 'public/css').options({
	processCssUrls: false
});

mix.css('resources/css/bootstrap.min.css', 'public/css').options({
	processCssUrls: false
});
mix.css('resources/css/animate.css', 'public/css').options({
	processCssUrls: false
});
mix.css('resources/css/owl.carousel.min.css', 'public/css').options({
	processCssUrls: false
});
mix.css('resources/css/font-awesome.min.css', 'public/css').options({
	processCssUrls: false
});
mix.css('resources/css/default/lineicons.min.css', 'public/css/default').options({
	processCssUrls: false
});

/*
 |--------------------------------------------------------------------------
 | suha - js
 |--------------------------------------------------------------------------
*/
mix.js('resources/js/bootstrap.bundle.min.js', 'public/js').vue();
mix.js('resources/js/jquery.min.js', 'public/js').vue();
mix.js('resources/js/waypoints.min.js', 'public/js').vue();
mix.js('resources/js/jquery.easing.min.js', 'public/js').vue();
mix.js('resources/js/owl.carousel.min.js', 'public/js').vue();
mix.js('resources/js/jquery.counterup.min.js', 'public/js').vue();
mix.js('resources/js/jquery.countdown.min.js', 'public/js').vue();

mix.js('resources/js/default/jquery.passwordstrength.js', 'public/js/default').vue();
mix.js('resources/js/default/dark-mode-switch.js', 'public/js/default').vue();
mix.js('resources/js/default/no-internet.js', 'public/js/default').vue();
mix.js('resources/js/default/active.js', 'public/js/default').vue();

mix.js('resources/js/pwa.js', 'public/js').vue();
