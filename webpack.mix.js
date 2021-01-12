const mix = require('laravel-mix');

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

// mix.styles([
//     'resources/assets/admin/plugins/fontawesome-free/css/all.min.css',
//     'resources/assets/admin/plugins/select2/css/select2.css',
//     'resources/assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.css',
//     'resources/assets/admin/css/adminlte.min.css'
// ], 'public/assets/admin/css/admin.css');

mix.sass('resources/sass/main.sass', 'public/css')
    .sass('resources/sass/admin.scss', 'public/css');

// mix.scripts([
//         'resources/assets/admin/plugins/jquery/jquery.js',
//         'resources/assets/admin/plugins/bootstrap/js/bootstrap.bundle.js',
//         // 'resources/assets/admin/plugins/bs-custom-file-input/bs-custom-file-input.js',
//         'resources/assets/admin/plugins/select2/js/select2.full.js',
//         'resources/assets/admin/js/adminlte.js'],
//     'public/assets/admin/js/admin.js');
// mix.scripts('resources/assets/admin/js/main.js', 'public/assets/admin/js/main.js');

mix.copyDirectory('resources/assets/admin/img', 'public/assets/admin/img');
mix.copyDirectory('resources/assets/admin/plugins/fontawesome-free/webfonts', 'public/assets/admin/webfonts');

// mix.copy('resources/assets/admin/css/adminlte.min.css.map', 'public/assets/admin/css/adminlte.min.css.map');
mix.browserSync('lara-modules.loc');
