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
                    'js/jquery.dataTables.js': 'datatables/media/js/jquery.dataTables.js'
                }
            },
            stylesheets: {
                files: {
                    'css/bootstrap.min.css':     'bootstrap/dist/css/bootstrap.min.css',
                    'css/font-awesome.css':      'font-awesome/css/font-awesome.css',
                    'css/jquery.dataTables.css': 'datatables/media/css/jquery.dataTables.css'
                }
            },
            fonts: {
                files: {
                    'fonts': 'font-awesome/fonts'
                }
            }
        }
    });

    grunt.loadNpmTasks('grunt-bowercopy');
    grunt.registerTask('default', 'bowercopy');
};