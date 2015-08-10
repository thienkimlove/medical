var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.styles([
           'bootstrap/dist/css/bootstrap.min.css',
           'metisMenu/dist/metisMenu.min.css',
           'font-awesome/css/font-awesome.min.css',
           'startbootstrap-sb-admin-2/dist/css/timeline.css',
           'startbootstrap-sb-admin-2/dist/css/sb-admin-2.css',
        ],'public/css/admin.css', 'resources/js/bower_components')
        .scripts([
            'jquery/dist/jquery.min.js',
            'bootstrap/dist/js/bootstrap.min.js',
            'metisMenu/dist/metisMenu.min.js',
            'raphael/raphael-min.js',
            'morrisjs/morris.min.js',
            'startbootstrap-sb-admin-2/dist/js/sb-admin-2.js'
        ], 'public/js/admin.js', 'resources/js/bower_components');
});
