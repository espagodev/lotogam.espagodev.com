let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application, as well as bundling up your JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js/init.js')
        .combine([
        'public/js/init.js',
        'resources/assets/js/jquery.min.js',
        'resources/assets/js/popper.min.js',
        'resources/plugins/bootstrap/js/bootstrap.min.js',
        'resources/plugins/accounting.min.js',
        'resources/plugins/simplebar/js/simplebar.js',
        'resources/assets/js/sidebar-menu.js',
        'resources/assets/js/app-script.js',
        'resources/plugins/lobibox-master/js/lobibox.js',
        'resources/plugins/lobibox-master/js/notifications.js',
        'resources/plugins/bootstrap-switch/bootstrap-switch.min.js',
        'resources/plugins/jquery-validation/js/jquery.validate.min.js',
        'resources/plugins/jquery-validation/js/messages_es.js',
        'resources/plugins/moment/moment.js',
        'resources/plugins/moment/moment-timezone-with-data.min.js',
        'resources/plugins/jquery-timepicker/jquery.timepicker.js',
        'resources/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
        // 'resources/plugins/bootstrap-timepicker/js/bootstrap-timepicker.js',
        'resources/plugins/daterangepicker/daterangepicker.js',
        'resources/plugins/bootstrap-datatable/js/jquery.dataTables.min.js',
        'resources/plugins/bootstrap-datatable/js/dataTables.bootstrap4.min.js',
        // 'resources/plugins/bootstrap-datatable/js/buttons.bootstrap4.min.js',
        // 'resources/plugins/bootstrap-datatable/js/jszip.min.js',
        // 'resources/plugins/bootstrap-datatable/js/pdfmake.min.js',
        // 'resources/plugins/bootstrap-datatable/js/vfs_fonts.js',
        // 'resources/plugins/bootstrap-datatable/js/buttons.html5.min.js',
        // 'resources/plugins/bootstrap-datatable/js/buttons.print.min.js',
        // 'resources/plugins/bootstrap-datatable/js/buttons.colVis.min.js',
        'resources/plugins/select2/js/select2.min.js',
        'resources/plugins/pace/pace.js',
        'resources/plugins/alerts-boxes/js/sweetalert.min.js',
        'resources/plugins/jquery-multi-select/jquery.multi-select.js',
        'resources/plugins/jquery-multi-select/jquery.quicksearch.js',
        'resources/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js',
        'resources/plugins/printThis.js',
        'resources/assets/validate/validate.js'
    ], 'public/js/vendor.js')
    .combine([
        'resources/assets/js/jquery.min.js',
        'resources/assets/js/popper.min.js',
        'resources/plugins/bootstrap/js/bootstrap.min.js'
    ], 'public/js/theme.js')
    .combine([
        'resources/plugins/bootstrap/css/bootstrap.css',
        'resources/assets/css/animate.css',
        'resources/assets/css/icons.css',
        'resources/assets/css/sidebar-menu.css',
        'resources/assets/css/app-style.css',
        'resources/assets/css/skins.css',
        'resources/plugins/jquery-timepicker/jquery.timepicker.css',
        'resources/plugins/lobibox-master/css/lobibox.css',
        'resources/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css',
        'resources/plugins/daterangepicker/daterangepicker.css',
        'resources/plugins/select2/css/select2.min.css',
        'resources/plugins/pace/themes/blue/pace-theme-flash.css',
        'resources/plugins/bootstrap-datatable/css/dataTables.bootstrap4.min.css',
        'resources/plugins/bootstrap-datatable/css/buttons.bootstrap4.min.css',
        'resources/plugins/simplebar/css/simplebar.css',
        'resources/plugins/switchery/css/switchery.min.css',
        'resources/plugins/bootstrap-switch/bootstrap-switch.min.css'
    ], 'public/css/vendor.css')
    .combine([
        'resources/plugins/bootstrap/css/bootstrap.min.css',
        'resources/assets/css/animate.css',
        'resources/assets/css/icons.css',
        'resources/assets/css/app-style.css'
    ], 'public/css/theme.css')
    .setResourceRoot('../');
