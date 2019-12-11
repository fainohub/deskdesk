const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

// mix.js('resources/js/app.js', 'public/js')
//    .sass('resources/sass/app.scss', 'public/css');


/*
 |--------------------------------------------------------------------------
 | Custom Theme
 |--------------------------------------------------------------------------
 */

// mix.sass('resources/theme/scss/style.scss', 'public/css');

mix.copy('resources/theme/css/style.css', 'public/css/style.css');

mix.copyDirectory('resources/theme/fonts', 'public/fonts');
mix.copyDirectory('resources/theme/images', 'public/images');
mix.copyDirectory('resources/theme/js', 'public/js');
mix.copyDirectory('resources/theme/vendors', 'public/vendors');


