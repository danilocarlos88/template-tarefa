module.exports = function (grunt) {
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    sass: {
      dist: {
        options: {
          style: 'expanded'
        },
        files: {
          'css/app.css': 'css/sass/app.scss'
        }
      }
    },
    cssmin: {
      options: {
        keepSpecialComments: 0
      },
      minify: {
        src: 'css/app.css',
        dest: 'css/app.min.css'
      }
    },
    concat: {
      js: {
        options: {
          separator: ';',
          stripBanners: {
            block: true,
            line: true
          },
          // Replace all 'use strict' statements in the code with a single one at the top
          banner: "'use strict';\n",
          process: function (src, filepath) {
            return '// Source: ' + filepath + '\n' +
            src.replace(/(^|\n)[ \t]*('use strict'|"use strict");?\s*/g, '$1')
          }
        },
        src: [
          'js/vendor/**/*.js',
          'js/dev/main.js'
        ],
        dest: 'js/app.js'
      }
    },
    uglify: {
      js: {
        files: {
          'js/app.min.js': ['js/app.js']
        }
      }
    },
    watch: {
      html: {
        files: ['**/*.php']
      },
      js: {
        files: ['js/dev/*.js', 'extras/**/*.js'],
        tasks: ['js']
      },
      css: {
        files: ['css/sass/*.scss'],
        tasks: ['css']
      },
      browser: {
        files: ['css/app.min.css', 'js/app.min.js'],
        options: {
          livereload: true
        }
      }
    }
  })

  grunt.loadNpmTasks('grunt-sass')
  grunt.loadNpmTasks('grunt-contrib-uglify')
  grunt.loadNpmTasks('grunt-contrib-concat')
  grunt.loadNpmTasks('grunt-contrib-cssmin')
  grunt.loadNpmTasks('grunt-contrib-watch')

  grunt.registerTask('css', ['sass', 'cssmin:minify'])
  grunt.registerTask('js', ['concat:js', 'uglify:js'])
}
