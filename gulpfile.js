var gulp  = require('gulp'),
    gutil = require('gulp-util');

var srcbase = {
    meta: 'l4/src/meta/',
    libs: 'l4/src/libs/',
    models: 'l4/src/models/',
    http: 'l4/src/Http/',
    resources: 'l4/src/resources/',
    layouts: 'l4/src/resources/views/layouts/',
    css: 'l4/src/css/',
    js: 'l4/src/js/',
};
var dstbase = {
    build: 'l4/build/',
    root: 'l4/build/myl5app/',
    app: 'l4/build/myl5app/app/',
    libs: 'l4/build/myl5app/app/Libs/',
    models: 'l4/build/myl5app/app/models/',
    resources: 'l4/build/myl5app/resources/',
    layouts: 'l4/build/myl5app/resources/views/layouts/',
    css: 'l4/build/myl5app/public/app/css/',
    js: 'l4/build/myl5app/public/app/js/',
};

var srcpaths = {
    setup: [srcbase.meta + 'setup/.bowerrc', srcbase.meta + 'setup/*'],
    foundation: [srcbase.meta + 'install-foundation/*'],
    //scripts: ['scripts/**/*.js', '!scripts/libs/**/*.js'],
    //libs: ['scripts/libs/jquery/dist/jquery.js', 'scripts/libs/underscore/underscore.js', 'scripts/backbone/backbone.js'],
    //styles: ['styles/**/*.css'],
    //html: ['index.html', '404.html'],
    //images: ['images/**/*.png'],
    //extras: ['crossdomain.xml', 'humans.txt', 'manifest.appcache', 'robots.txt', 'favicon.ico'],
};

gulp.task('default', ['watch']);

gulp.task('copysrc', function() {
    gulp.src(srcbase.libs+'*.php')
   .pipe(gulp.dest(dstbase.libs));

    gulp.src(srcbase.models+'*.php')
   .pipe(gulp.dest(dstbase.models));

    gulp.src(srcbase.http+'Controllers/*.php')
   .pipe(gulp.dest(dstbase.root+'app/Http/Controllers'));

    gulp.src(srcbase.http+'Controllers/Site/*.php')
   .pipe(gulp.dest(dstbase.root+'app/Http/Controllers/Site'));

    gulp.src(srcbase.layouts+'*.php')
   .pipe(gulp.dest(dstbase.layouts));

    gulp.src(srcbase.resources+'views/site/siteconfigs/*.php')
   .pipe(gulp.dest(dstbase.root+'resources/views/site/siteconfigs'));

    gulp.src(srcbase.css+'/**/*.css',{base: "."})
   .pipe(gulp.dest(dstbase.css));
});



gulp.task('watch', function() {
    gulp.watch('l4/src/**/{*.css,*.js,*.php}', ['copysrc']);
});

gulp.task('install-foundation', function() {
    gulp.src(srcpaths.setup)
    .pipe(gulp.dest(dstbase.app));

    gulp.src(srcpaths.foundation)
    .pipe(gulp.dest(dstbase.app + 'resources/assets/sass/'));
});
