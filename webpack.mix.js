const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Custom Theme
 |--------------------------------------------------------------------------
 */

mix.copy('node_modules/pnotify/dist/iife/PNotify.js', 'public/js/PNotify.js');
mix.copy('node_modules/pnotify/dist/iife/PNotifyButtons.js', 'public/js/PNotifyButtons.js');
mix.copy('resources/theme/css/style.css', 'public/css/style.css');

mix.copyDirectory('resources/images', 'public/images');
mix.copyDirectory('resources/theme/fonts', 'public/fonts');
mix.copyDirectory('resources/theme/js', 'public/js');
mix.copyDirectory('resources/theme/vendors', 'public/vendors');


