const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Custom Theme
 |--------------------------------------------------------------------------
 */

mix.copy('node_modules/pnotify/dist/iife/PNotify.js', 'public/js/PNotify.js');
mix.copy('node_modules/pnotify/dist/iife/PNotify.js.map', 'public/js/PNotify.js.map');
mix.copy('node_modules/pnotify/dist/iife/PNotifyButtons.js', 'public/js/PNotifyButtons.js');
mix.copy('node_modules/pnotify/dist/iife/PNotifyButtons.js.map', 'public/js/PNotifyButtons.js.map');

mix.copyDirectory('resources/images', 'public/images');
mix.copyDirectory('resources/theme/css', 'public/css');
mix.copyDirectory('resources/theme/fonts', 'public/fonts');
mix.copyDirectory('resources/theme/js', 'public/js');
mix.copyDirectory('resources/theme/vendors', 'public/vendors');


