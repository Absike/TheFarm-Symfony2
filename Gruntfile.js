module.exports = function (grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        bowercopy: {
            options: {
                srcPrefix: 'bower_components',
                destPrefix: 'web/assets'
            },
            scripts: {
                files: {
                    'js/jquery.js':            'jquery/dist/jquery.js',
                    'js/bootstrap.min.js':     'bootstrap/dist/js/bootstrap.min.js',
                    'js/highcharts.js':        'highcharts/highcharts.js',
                    'js/underscore-min.js':    'underscore/underscore-min.js',
                    'js/moment.min.js':        'moment/min/moment.min.js',
                    'js/jquery.dataTables.js': 'datatables/media/js/jquery.dataTables.js',
                    'js/jquery-ui.min.js':     'jquery-ui/ui/minified/jquery-ui.min.js',
                    'js/jquery.datetimepicker.js': 'datetimepicker/jquery.datetimepicker.js',
                    'js/jquery.validate.min.js': 'jquery-validation/dist/jquery.validate.min.js',
                    'js/select2.min.js':'select2/dist/js/select2.min.js',
            }
            },
            stylesheets: {
                files: {
                    'css/bootstrap.min.css':     'bootstrap/dist/css/bootstrap.min.css',
                    'css/font-awesome.css':      'font-awesome/css/font-awesome.css',
                    'css/jquery.dataTables.css': 'datatables/media/css/jquery.dataTables.css',
                    'css/jquery-ui.min.css': 'jquery-ui/themes/flick/jquery-ui.min.css',
                    'css/jquery.datetimepicker.css': 'datetimepicker/jquery.datetimepicker.css',
                    'css/select2.min.css':'select2/dist/css/select2.min.css'
                }
            },
            fonts: {
                files: {
                    'fonts': 'font-awesome/fonts',
                    'fonts': 'bootstrap/fonts/*'
                }
            },
            images: {
                files: {
                    'images': 'datatables/media/images/*',
                    'css/images': 'jquery-ui/themes/flick/images/*'
                }
            }
        }
    });

    grunt.loadNpmTasks('grunt-bowercopy');
    grunt.registerTask('default', 'bowercopy');
};