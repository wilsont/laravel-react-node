var elixir = require('laravel-elixir');
require('./gulp/renderServer');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('app.scss');
    mix.renderServer();
    mix.browserify('global.js', 'public/js/global.js');
    mix.browserify('components.js', 'public/js/components.js');
});
