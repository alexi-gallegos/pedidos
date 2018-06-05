let mix = require('laravel-mix');

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


mix.scripts(['resources/assets/js/jquery.js',
            'resources/assets/js/vue.js',
             'resources/assets/js/axios.js',
             'resources/assets/js/bootstrap.js', 
             'resources/assets/js/app.js',
             'resources/assets/js/js.js',
             'resources/assets/js/notify.js',
             'resources/assets/js/jquery-confirm.js'
                ], 'public/js/app.js'
            );

            mix.js('resources/assets/js/chartjs.js','public/js/chartjs.js');



   mix.styles([
          'resources/assets/css/bootstrap.min.css',
         ], 'public/css/bootstrap.css'  );

         mix.styles([ 'resources/assets/css/bootstrap-grid.min.css',
         'resources/assets/css/app.css',
         'resources/assets/css/jquery-confirm.css'],'public/css/app.css')