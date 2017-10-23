var gulp = require('gulp');
var sass = require('gulp-sass');
var prefixCss = require('gulp-autoprefixer');
var rename = require('gulp-rename');
var browserSync = require('browser-sync').create();
var apBrowsers = {
    browsers :[
  "Android 2.3",
  "Android >= 4",
  "Chrome >= 20",
  "Firefox >= 24",
  "Explorer >= 8",
  "iOS >= 6",
  "Opera >= 12",
  "Safari >= 6"
]};

gulp.task('sass', function() {
  console.log('Start Compiling...');
  return gulp.src('./wp-content/themes/cornerstone/sass/style.scss')
    .pipe(sass({
      loadPaths: [
        'node_modules/foundation-sites/scss',
      ],
      includePaths: [
        'node_modules/foundation-sites/scss',
      ]
    }))
    .pipe(prefixCss(apBrowsers))
    .pipe(rename('style.css'))
    .pipe(gulp.dest('./wp-content/themes/cornerstone/'))
    .pipe(browserSync.stream());
   console.log('Done Compiling...'); 
});

gulp.task('default', ['sass'], function() {

    browserSync.init({
         proxy: 'cornerstone.dev',
         port: 8000
    });

    gulp.watch("./wp-content/themes/cornerstone/sass/**/*.scss", ['sass']);
});

