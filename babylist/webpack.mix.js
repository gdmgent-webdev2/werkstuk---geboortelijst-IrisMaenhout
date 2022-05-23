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

mix.js('resources/js/app.js', 'public/js').postCss('resources/css/app.css', 'public/css', [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
]);

mix.js('resources/js/share-add-email.js', 'public/js');
mix.js('resources/js/show-description-babylist.js', 'public/js');
mix.js('resources/js/toggle-filter.js', 'public/js');
mix.js('resources/js/close-popup.js', 'public/js');
