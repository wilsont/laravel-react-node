const elixir = require('laravel-elixir');
const server = require('gulp-express');
const gutils = require('gulp-util');

elixir.extend('renderServer', () => {
  // it will only run during gulp watch
  if (gutils.env._.indexOf('watch') > -1) {
    server.stop();
    server.run(['./www-node/render-server.js']);

    new elixir.Task('renderServerNotify', () => {
      server.stop();
      server.run(['./www-node/render-server.js']);
    }).watch('./public/js/components.js');

    process.on('uncaughtException', () => {
      server.stop();
    });
  }
});
