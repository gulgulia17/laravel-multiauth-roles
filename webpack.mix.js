const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/assets/css/')
    .sass('resources/sass/app.scss', 'public/assets/js/');
