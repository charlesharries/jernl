/* eslint-disable global-require */
const mix = require('laravel-mix');
require('laravel-mix-postcss-config');

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

mix
  .js('resources/js/app.js', 'public/js')
  .postCss('resources/css/main.css', 'public/css')
  .postCssConfig({
    plugins: [
      require('postcss-import')({}),
      require('postcss-mixins')({}),
      require('postcss-calc')({}),
      require('postcss-nested')({}),
      require('postcss-color-mod-function')({}),
      require('postcss-preset-env')({
        stage: 1,
      }),
    ],
  });
