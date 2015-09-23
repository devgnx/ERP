var gulp   = require('gulp'),
    elixir = require('laravel-elixir');

module.exports = function(grunt) {
  'use strict';

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    path: grunt.file.readJSON('path.json'),

    clean: ['<%= path.temp %>'],

    /**
     * Sass task
     * @type {Object}
     */
    sass: {
      default: {
        options: { style: 'compressed' },
        files: [{
          expand: true,
          cwd: '<%= path.src.sass %>',
          src: ['!app.scss', '**/*.scss'],
          dest: '<%= path.dist.css %>',
          ext: '.min.css'
        }]
      },
      app: {
        options: {
          sourcemap: 'none',
          style: 'compressed'
        },
        files: {
          '<%= path.temp %>/app.css': '<%= path.src.sass %>/app.scss'
        }
      }
    },

    /**
     * Stylesheets minification
     * @type {Object}
     */
    cssmin: {
      _app_files: [
        '<%= path.vendor %>/normalize-css/normalize.css',
        '<%= path.vendor %>/locawebstyle/dist/stylesheets/locastyle.css',
        '<%= path.temp %>/app.css'
      ],
      app: {
        files: {
          '<%= path.dist.css %>/app.min.css': '<%= cssmin._app_files %>',
        }
      }
    },

    /**
     * Copy files
     * @type {Object}
     */
    copy: {
      fonts: {
        files: [{
          expand: true,
          dot: true,
          cwd: '<%= path.vendor %>/locawebstyle/dist/stylesheets/fonts',
          src: ['*.ttf', '*.woff'],
          dest: '<%= path.dist.css %>/fonts'
        }]
      }
    },

    /**
     * Uglify scripts
     * @type {Object}
     */
    uglify: {
      options: {
        mangle: false,
        preserveComments: false
      },
      _app_files: [
        '<%= path.vendor %>/jquery/dist/jquery.min.js',
        '<%= path.vendor %>/locawebstyle/dist/javascripts/locastyle.js',
        '<%= path.src.js %>/app.js'
      ],
      app: {
        files: {
          '<%= path.dist.js %>/app.min.js': '<%= uglify._app_files %>'
        }
      },
      _products_files: [
        '<%= path.src.js %>/lib/products.js',
        '<%= path.src.js %>/products.js'
      ],
      products: {
        files: {
          '<%= path.dist.js %>/products.min.js': '<%= uglify._products_files %>'
        }
      }
    },

    /**
     * Merge SVGs.
     * @type {Object}
     */
    svgstore: {
      options: {
        prefix : 'shape-',
        svg: {
          style: 'display: none;'
        }
      },
      icons: {
        files: {
          '<%= path.views %>/partials/svgicons.blade.php': ['<%= path.src.svg %>/icons/*.svg']
        }
      },
    },

    /**
     * Images minification
     * @type {Object}
     */
    imagemin: {
      img: {
        files: [{
          expand: true,
          cwd: '<%= path.src.img %>',
          src: ['{,*/}*.{ico,png,jpg,jpeg,gif,webp}'],
          dest: '<%= path.dist.img %>'
        }]
      }
    },

    /**
     * Watch files
     * @type {Object}
     */
    watch: {
      sass: {
        files: ['<%= path.src.sass %>/**/*.scss'],
        tasks: ['clean', 'sass', 'cssmin', 'clean'],
        options: {
          livereload: true
        }
      },
      js_app: {
        files: '<%= uglify._app_files %>',
        tasks: ['uglify:app'],
        options: {
          livereload: true
        }
      },
      js_products: {
        files: '<%= uglify._products_files %>',
        tasks: ['uglify:products'],
        options: {
          livereload: true
        }
      },
      fonts: {
        files: [
          '<%= path.vendor %>/locawebstyle/dist/stylesheets/fonts{*.ttf, *.woff}'
        ],
        tasks: ['copy:fonts'],
        options: {
          livereload: true
        }
      },
      svg: {
        files: ['<%= path.src.svg %>**/*.svg'],
        tasks: ['svgstore'],
        options: {
          livereload: true
        }
      },
      img: {
        files: [
          '<%= path.src.img %>/**/*.{ico,png,jpg,jpeg,gif,webp,svg}',
        ],
        tasks: ['imagemin:img'],
        options: {
          livereload: true
        }
      },
      tests: {
        files: ['./app/Http/Controllers/*.php', './app/Models/*.php'],
        tasks: ['phpunit'],
        options: {
          livereload: true
        }
      }
    }
  });

  // Loading dependencies
  for (var key in grunt.file.readJSON('package.json').devDependencies) {
    if (key !== 'grunt' && key.indexOf('grunt') == 0) {
      grunt.loadNpmTasks(key);
    }
  }

  grunt.registerTask('build', [
    'clean',
    'sass',
    'cssmin',
    'copy',
    'uglify',
    'svgstore',
    'imagemin',
    'clean'
  ]);

  grunt.registerTask('default', ['build']);
};
