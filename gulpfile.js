var gulp = require('gulp');
var sass = require('gulp-sass');
var prefixCss = require('gulp-autoprefixer');
var rename = require('gulp-rename');
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


gulp.task('default', function() {
    console.log('gulping');
});

gulp.task('sass', function() {
    gulp.src('./web/wp-content/themes/cornerstone/assets/sass/style.scss')
    .pipe(sass())
    .pipe(prefixCss(apBrowsers))
    .pipe(rename('style.css'))
    .pipe(gulp.dest('./web/wp-content/themes/cornerstone/'));
    console.log('compiling...');
});

gulp.task('watch', function() {
    gulp.watch('./web/wp-content/themes/cornerstone/assets/sass/**/*.scss', ['default','sass']);
});

