var gulp  = require('gulp'),
    gutil = require('gulp-util');

var srcbase = {
    meta: 'l5/src/meta/',
    libs: 'l5/src/libs/',
    models: 'l5/src/models/',
    http: 'l5/src/Http/',
    resources: 'l5/src/resources/',
    layouts: 'l5/src/resources/views/layouts/',
    css: 'l5/src/css/',
    js: 'l5/src/js/',
};
var dstbase = {
    build: 'l5/build/',
    root: 'l5/build/myl5app/',
    app: 'l5/build/myl5app/app/',
    libs: 'l5/build/myl5app/app/Libs/',
    models: 'l5/build/myl5app/app/models/',
    resources: 'l5/build/myl5app/resources/',
    layouts: 'l5/build/myl5app/resources/views/layouts/',
    css: 'l5/build/myl5app/public/app/css/',
    js: 'l5/build/myl5app/public/app/js/',
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

gulp.task('init', function() {
    if (gutil.env.BUILDDIR === undefined) {
        throw new gutil.PluginError({ plugin: 'deploy', message: 'BUILDDIR env variable is undefined.' });
    }
     process.stdout.write('Initiaizing: BUILDIR='+gutil.env.BUILDDIR+'\n');
});

gulp.task('default', ['watch']);

gulp.task('copysrc', ['init'], function() {
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



gulp.task('watch', ['init'], function() {
    gulp.watch('l5/src/**/{*.css,*.js,*.php}', ['copysrc']);
});

gulp.task('install-foundation', ['init'], function() {
    gulp.src(srcpaths.setup)
    .pipe(gulp.dest(dstbase.app));

    gulp.src(srcpaths.foundation)
    .pipe(gulp.dest(dstbase.app + 'resources/assets/sass/'));
});
