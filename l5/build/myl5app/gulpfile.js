var elixir = require('laravel-elixir');

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

    // Compile CSS
    mix.sass(
        'app.scss', // Source files
        'public/css/vendor', // Destination folder
        {includePaths: ['vendor/bower_components/foundation/scss']}
    );

    // Compile JavaScript
    mix.scripts(
        ['vendor/modernizr.js', 'vendor/jquery.js', 'foundation.min.js'], // Source files. You can also selective choose only some components
        'public/js/vendor/app.js', // Destination file
        'vendor/bower_components/foundation/js/' // Source files base directory
    );


});
