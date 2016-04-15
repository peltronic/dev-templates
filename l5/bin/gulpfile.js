// [ ] .gitignore
var gulp  = require('gulp'),
    gutil = require('gulp-util');

var dstroot = gutil.env.BUILDDIR+'/myl5app/';
var dstapp = gutil.env.BUILDDIR+'/myl5app/app/';

var srcbase = {
    http: '../src/Http/',
    libs: '../src/libs/',
    models: '../src/models/',
    resources: {
        views: {
            layouts: '../src/resources/views/layouts/',
            site: '../src/resources/views/site/',
        },
    },
    meta: '../src/meta/',
    appcss: '../src/css/',
    appjs: '../src/js/',
};
var dstbase = {
    http: dstapp+'Http/',
    libs: dstapp+'Libs/',
    models: dstapp+'Models/',
    resources: {
        views: {
            layouts: dstroot+'resources/views/layouts/',
            site: dstroot+'resources/views/site/',
        },
        assets: dstroot+'resources/assets/',
    },
    appcss: dstroot+'/public/css/app/',
    appjs: dstroot+'/public/js/app/',
};
var srcpaths = {
    setup: [srcbase.meta+'setup/.bowerrc', srcbase.meta+'setup/*'],
    //scripts: ['scripts/**/*.js', '!scripts/libs/**/*.js'],
    //libs: ['scripts/libs/jquery/dist/jquery.js', 'scripts/libs/underscore/underscore.js', 'scripts/backbone/backbone.js'],
    //html: ['index.html', '404.html'],
    //images: ['images/**/*.png'],
    //extras: ['crossdomain.xml', 'humans.txt', 'manifest.appcache', 'robots.txt', 'favicon.ico'],
};

//=================================================
// Zurb Foundation
//=================================================
gulp.task('setup-foundation', ['init'], function() {
    gulp.src(srcpaths.setup).pipe(gulp.dest(dstroot));
});
gulp.task('install-foundation', ['init'], function() {
    gulp.src(srcbase.meta+'install-foundation/*.scss').pipe(gulp.dest(dstbase.resources.assets+'sass/'));
    gulp.src(srcbase.meta+'install-foundation/gulpfile.js').pipe(gulp.dest(dstroot));
});


//=================================================
// Copy src
//=================================================
gulp.task('copyresources', ['init'], function() {
    gulp.src(srcbase.resources.views.layouts+'/**/*.php',{base: srcbase.resources.views.layouts}).pipe(gulp.dest(dstbase.resources.views.layouts));
    gulp.src(srcbase.resources.views.site+'/**/*.php',{base: srcbase.resources.views.site}).pipe(gulp.dest(dstbase.resources.views.site));
});
gulp.task('copylibs', ['init'], function() {
    gulp.src(srcbase.libs+'*.php').pipe(gulp.dest(dstbase.libs));
});
gulp.task('copymodels', ['init'], function() {
    gulp.src(srcbase.models+'*.php').pipe(gulp.dest(dstbase.models));
});
gulp.task('copyhttp', ['init'], function() {
    gulp.src(srcbase.http+'routes.php').pipe(gulp.dest(dstbase.http)); // routes
    gulp.src(srcbase.http+'Controllers/Controller.php').pipe(gulp.dest(dstbase.http+'Controllers/')); // base controller
    gulp.src(srcbase.http+'Controllers/Site/*.php').pipe(gulp.dest(dstbase.http+'Controllers/Site/'));
});
gulp.task('copycss', ['init'], function() {
    gulp.src(srcbase.appcss+'/**/*.css',{base: srcbase.appcss}).pipe(gulp.dest(dstbase.appcss));
});
gulp.task('copyjs', ['init'], function() {
    gulp.src(srcbase.appjs+'/**/*.js',{base: srcbase.appjs}).pipe(gulp.dest(dstbase.appjs));
});
// group task to install all source
gulp.task('copysrc', ['copyhttp','copylibs','copymodels','copyresources','copycss','copyjs'], function() {
});



//=================================================
// INIT
//=================================================
gulp.task('init', function() {
    if (gutil.env.BUILDDIR === undefined) {
        throw new gutil.PluginError({ plugin: 'deploy', message: 'BUILDDIR env variable is undefined.' });
    }
     process.stdout.write('Initiaizing: BUILDIR='+gutil.env.BUILDDIR+'\n');
});

gulp.task('default', ['watch']);


//=================================================
// WATCH
//=================================================
// %FIXME
gulp.task('watch', ['init'], function() {
    gulp.watch(srcbase.http+'/**/{*.php}', ['copyhttp']);
});



