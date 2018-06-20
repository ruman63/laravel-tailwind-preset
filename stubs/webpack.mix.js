let mix = require('laravel-mix')
require('laravel-mix-purgecss')
require('laravel-mix-tailwind')

mix.js('resources/assets/js/app.js', 'public/js')
  .sass('resources/assets/sass/app.sass', 'public/css')
  .tailwind()
  .purgeCss()

if (mix.inProduction()) {
  mix.version()
}
