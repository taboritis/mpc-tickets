let mix = require('laravel-mix');

mix.sass('resources/sass/app.scss', 'public/css').sourceMaps();
mix.js('resources/js/app.js', 'public/js').sourceMaps();

mix.browserSync('http://mpc-tickets.test/users');

