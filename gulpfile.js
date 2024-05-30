'use strict';

/**
 * Gulpfile
 */

// Utils
import fs       from 'fs';
import path     from 'path';
import log      from 'fancy-log';
import through2 from 'through2';
import {deleteAsync} from 'del';

// Gulps
import gulp     from 'gulp';
import concat   from 'gulp-concat';
import plumber  from 'gulp-plumber';
import inject   from 'gulp-inject';
import rename   from 'gulp-rename';
import clone    from 'gulp-clone';
import cache    from 'gulp-cache';

// JS
import uglify   from 'gulp-uglify';

// SASS
import *as dartSass from 'sass';
import gulpSass from 'gulp-sass';
const sass = gulpSass(dartSass);

// CSS
import postcss          from 'gulp-postcss';
import sassGlob         from 'gulp-sass-glob';
import csso             from 'postcss-csso';
import autoprefixer     from 'autoprefixer';
import mqpacker         from 'node-css-mqpacker';
import discardComments  from 'postcss-discard-comments';

// Images
import imagemin         from 'gulp-imagemin';
import imageminPngquant from 'imagemin-pngquant';
import imageminMozjpeg  from 'imagemin-mozjpeg';
import imageminGifsicle from 'imagemin-gifsicle';

// SVG
/*import svgstore         from 'gulp-svgstore';
import svgmin           from 'gulp-svgmin';*/

// Wordpress
import wpPot            from 'gulp-wp-pot';

// BrowserSync
import browserSync      from 'browser-sync';

// Get Gulp options from package.json
import { createRequire } from 'module';
const require = createRequire(import.meta.url);
const config  = require('./package.json').gulp;

// Set theme directory
const themePath = `./wp-content/themes/${config.theme_slug}`;
const assetPath = `./assets`;


/**
 * Helper Functions
 */

// Update file date modified
const update_file_timestamp = () => {
  return through2.obj( (file, enc, cb) => {
    var date = new Date();
    file.stat.atime = date;
    file.stat.mtime = date;
    cb( null, file );
  });
};


/**
 * BrowserSync
 */

gulp.task('browser-sync', () => {
  browserSync.init({
    proxy: 'http://goodfortunejewelry.local',
  });
});


/**
 * SASS
 * ----
 */

gulp.task('sass', () => {
  var processors = [
    // Autoprefixr uses settings from
    // 'browserslist' in package.json
    autoprefixer(),
    mqpacker({
      sort: true
    }),
    discardComments()
  ];

  return gulp.src([
      `${assetPath}/sass/*.scss`,
    ])
    .pipe(plumber((error) => {
      log.error( error.message );
      this.emit('end');
    }))
    .pipe(sassGlob({
      ignorePaths: [
        '**/!_*.scss',
      ]
    }))
    .pipe(sass.sync().on('error', sass.logError))
    .pipe(postcss(processors))
    .pipe(update_file_timestamp())
    .pipe(gulp.dest( `${assetPath}/css` ));
});


/**
 * CSS
 * ---
 * Creates min file while preserving the original
 */

gulp.task('css:minify', () => {
  var processors = [
    csso({
      comments: false,
      restructure: false,
    })
  ];

  return gulp.src([
    `${assetPath}/css/*.css`,
    `!${assetPath}/css/*.min.css`,
  ])
    .pipe(clone())
    .pipe(rename((path) => {
      path.basename += '.min';
      path.extname = '.css';
    }))
    .pipe(postcss(processors))
    .pipe(update_file_timestamp())
    .pipe(gulp.dest( `${assetPath}/css` ))
    .pipe(browserSync.stream());
});


/**
 * Images
 * ---
 * [https://github.com/sindresorhus/gulp-imagemin]
 * [https://github.com/jgable/gulp-cache]
 * [https://github.com/imagemin/imagemin-pngquant]
 * [https://github.com/imagemin/imagemin-mozjpeg]
 */

gulp.task('img:minify', () => {
  return gulp.src([
    `${assetPath}/img/src/**/*.+(png|jpg|jpeg|gif)`,
  ])
    .pipe(cache(imagemin([
      imageminGifsicle({
        interlaced: true,
      }),
      imageminMozjpeg({
        quality: 80,
        progressive: true,
      }),
      imageminPngquant({
        speed: 3,
        strip: true,
        quality: [ 0.65, 0.8 ]
      })
    ])))
    .pipe(update_file_timestamp())
    .pipe(gulp.dest( `${assetPath}/img/dist` ))
    .pipe(browserSync.stream());
});

gulp.task('img:clear-cache', (done) => {
  cache.clearAll();
  done();
});



/**
 * JS
 * --
 */

gulp.task('js', () => {
  return gulp.src([
    `${assetPath}/js/libs/*.js`,
    `${assetPath}/js/plugins/*.js`,
    `${assetPath}/js/*.js`,
    `!${assetPath}/js/**/!*.js`,
  ])
    .pipe(plumber())
    .pipe(concat('site.js'))
    .pipe(update_file_timestamp())
    .pipe(gulp.dest( `${assetPath}/js/build` ));
});

gulp.task('js:minify', () => {
  return gulp.src([
    `${assetPath}/js/build/*.js`,
    `!${assetPath}/js/build/*.min.js`,
  ])
    .pipe(clone())
    .pipe(uglify())
    .pipe(rename((path) => {
      path.basename += '.min';
      path.extname = '.js';
    }))
    .pipe(update_file_timestamp())
    .pipe(gulp.dest( `${assetPath}/js/build` ))
    .pipe(browserSync.stream());
});


/**
 * Translations
 * ---
 * [https://www.npmjs.com/package/gulp-wp-pot]
 * [https://github.com/wp-pot/wp-pot#options]
 *
 * Generates `.pot` file for theme
 */

gulp.task('translate', () => {
  const translationsPath = `./translations`;

  return gulp.src([
    `./**/*.php`,
  ])
    .pipe(wpPot({
      domain: config.theme_slug,
    }))
    .pipe(gulp.dest( `${translationsPath}/${config.theme_slug}.pot` ));
});


/**
 * Watchers
 * ---
 */

// Watch js files
gulp.task('watch_js', () => {
  return gulp.watch([
    `${assetPath}/js/**/*.js`,
    `!${assetPath}/js/build/**/*.js`,
  ])
    .on('change', gulp.series( 'js', 'js:minify' ))
    .on('add', gulp.series( 'js', 'js:minify' ))
    .on('unlink', gulp.series( 'js', 'js:minify' ));
});

// Watch sass files
gulp.task('watch_sass', () => {
  return gulp.watch([
    `${assetPath}/sass/**/*.scss`,
  ])
    .on('change', gulp.series( 'sass', 'css:minify' ))
    .on('add', gulp.series( 'sass', 'css:minify' ))
    .on('unlink', gulp.series( 'sass', 'css:minify' ));
});

// Watch img files
gulp.task('watch_img', () => {
  return gulp.watch([
    `${assetPath}/img/src/**/*.+(png|jpg|jpeg|gif)`,
  ])
    .on('change', gulp.series( 'img:minify' ))
    .on('add', gulp.series( 'img:minify' ))
    .on('unlink', (filepath) => {
      var img_src_path  = path.relative( path.resolve( `${assetPath}/img/src` ), filepath );
      var img_dist_path = path.resolve( `${assetPath}/img/dist`, img_src_path );

      if ( img_dist_path !== null ) {
        deleteAsync([img_dist_path])
          .then(function () {
            log( 'Deleted: ' + img_dist_path );
          });
      }
    });
});



/**
 * Main Tasks
 * ---
 */

// Watch
gulp.task('watch', gulp.parallel( 'watch_js', 'watch_sass', 'watch_img' ));

// Default Task
gulp.task('default', gulp.series( 'img:clear-cache', 'watch' ));

// Serve Task
gulp.task('serve', gulp.series( 'img:clear-cache', gulp.parallel( 'browser-sync', 'watch' )));
