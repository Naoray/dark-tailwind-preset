const mix = require('laravel-mix');

require('laravel-mix-tailwind')
require('laravel-mix-purgecss');

mix.js('resources/js/app.js', 'js')
   .sass('resources/sass/app.scss', 'css')
   .copyDirectory('resources/img', 'public/img')
   .tailwind();

if (mix.inProduction()) {
   mix.purgeCss()
      .version()
}