module.exports = function(grunt) {
        grunt.initConfig({
                pkg: grunt.file.readJSON('package.json'),
                sass: {
                        dist: {
                                files: {
                                        './templates/loopshape/assets/css/base.css' : './templates/loopshape/assets/sass/base.scss'
                                },
                                options: {
                                        style: 'compressed'
                                }
                        }
                },
                watch: {
                        css: {
                                files: '**/*.scss',
                                tasks: ['sass']
                        }
                }
        });
        grunt.loadNpmTasks('grunt-contrib-sass');
        grunt.loadNpmTasks('grunt-contrib-watch');
        grunt.registerTask('default',['watch']);
}

