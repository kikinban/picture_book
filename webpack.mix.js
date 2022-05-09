const mix = require('laravel-mix');
//const NodePolyfillPlugin = require("node-polyfill-webpack-plugin");
//const TerserPlugin = require("terser-webpack-plugin");
//const nodeExternals = require('webpack-node-externals');

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

mix.js('resources/js/app.js', 'public/js')
.js('resources/js/dashboard.js', 'public/js')
.postCss('resources/css/app.css', 'public/css', [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
])
.sass('resources/css/app.scss', 'public/css')
.sass('resources/css/master.scss', 'public/css')
.sass('resources/css/dashboard.scss', 'public/css')
.vue()
.sourceMaps();
