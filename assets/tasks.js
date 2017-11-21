/**
 * GulpFile Tasks
 *
 * @copyright Copyright (c) 2017, hugw.io
 * @author Hugo W - me@hugw.io
 * @license GPLv2
 */

import gulp from 'gulp'
import watch from 'gulp-watch'
import util from 'gulp-util'
import plumber from 'gulp-plumber'
import rename from 'gulp-rename'
import concat from 'gulp-concat'
import cssmin from 'gulp-minify-css'
import autoprefixer from 'gulp-autoprefixer'
import sass from 'gulp-sass'
import uglify from 'gulp-uglify'
import babel from 'gulp-babel'
import runsec from 'run-sequence'

/**
 * Config settings
 */
const config = {
  styles: {
    src: ['./assets/scss/**/*.scss', '!./assets/scss/bloomcss/**/*.scss'],
    dest: './assets/css/'
  },
  scripts: {
    src: './assets/js/bloom.js',
    dest: './assets/js/',
    file: 'bloom.min.js'
  }
}

/**
 * Error handler
 *
 * Invoked by plumber and
 * other error and warning
 * listeners
 */
const onError = (err) => {
  util.beep()
  util.log(util.colors.red(err))
}

/**
 * Styles task
 *
 * All .scss are compiled
 * into .css files
 */
gulp.task('_dev:styles', () => (
  gulp.src(config.styles.src)
    .pipe(plumber({ errorHandler: onError }))
    .pipe(sass().on('error', sass.logError))
    // Strip comments and keep line breaks
    .pipe(autoprefixer({
      browsers: ['last 2 versions'],
    }))
    .pipe(cssmin({
      keepSpecialComments: 1,
      rebase: true,
      keepBreaks: true,
      processImport: false
    }))
    .pipe(rename({ dirname: '' }))
    // Generate .css
    .pipe(gulp.dest(config.styles.dest))
    // Now minify and strip line breaks
    .pipe(cssmin({
      keepSpecialComments: 1,
      rebase: true,
      processImport: false
    }))
    .pipe(rename({ extname: '.min.css', dirname: '' }))
    // Generate .min.css
    .pipe(gulp.dest(config.styles.dest))
))

/**
 * Scripts task
 *
 * Bundle js scripts
 * into a single file
 */
gulp.task('_dev:scripts', () => (
  gulp.src(config.scripts.src)
    .pipe(plumber({ errorHandler: onError }))
    .pipe(babel({ presets: ['env'] }))
    .pipe(concat(config.scripts.file))
    .pipe(uglify({
      output: { comments: /^!/i }
    }))
    .pipe(gulp.dest(config.scripts.dest))
))

/**
 * Watch task
 *
 * Watch files and folder to auto
 * rerun specific tasks
 */
gulp.task('_dev:watch', () => {
  watch(config.styles.src, { verbose: true }, () => runsec('_dev:styles'))
  watch(config.scripts.src, { verbose: true }, () => runsec('_dev:scripts'))
})

/**
 * Global tasks
 *
 * "Public" tasks to be
 * invoked on console
 * with gulp or via package scripts
 */
gulp.task('default', ['_dev:styles', '_dev:scripts'])
gulp.task('dev', ['default', '_dev:watch'])
