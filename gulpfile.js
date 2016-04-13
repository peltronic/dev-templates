var gulp  = require('gulp'),
    gutil = require('gulp-util');

gulp.task('default', ['watch']);

gulp.task('copysrc', function() {
    gulp.src('./l4/src/Http/Controllers/Site/*.php')
   .pipe(gulp.dest('./l4/build/myl5app/app/Http/Controllers/Site'));

    gulp.src('./l4/src/resources/views/site/siteconfigs/*.php')
   .pipe(gulp.dest('./l4/build/myl5app/resources/views/site/siteconfigs'));
});



gulp.task('watch', function() {
  gulp.watch('l4/src/**/{*.js,*.php}', ['copysrc']);
});
