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

mix.js('resources/js/admin.js', 'public/js/admin.js')
    .js('resources/js/user.js', 'public/js/user.js')
    .postCss('resources/css/admin.css', 'public/css/admin.css', [
        require("tailwindcss")
    ])
    .postCss('resources/css/user.css', 'public/css/user.css', [
        require("tailwindcss")
    ]);
