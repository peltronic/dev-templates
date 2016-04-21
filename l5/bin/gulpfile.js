// [ ] .gitignore
var gulp  = require('gulp'),
    gutil = require('gulp-util'),
    gflatten = require('gulp-flatten');

var dstroot = gutil.env.BUILDDIR+'/myl5app/';
var dstapp = gutil.env.BUILDDIR+'/myl5app/app/';

var srcbase = {
    src: '../src/',
    http: '../src/Http/',
    libs: '../src/libs/',
    models: '../src/models/',
    resources: {
        views: {
            layouts: '../src/resources/views/layouts/',
            site: '../src/resources/views/site/',
            admin: '../src/resources/views/admin/',
            auth: '../src/resources/views/auth/',
        },
    },
    meta: '../src/meta/',
    appcss: '../src/css/',
    appjs: '../src/js/',
    vendor: {
        plupload: {
            js: '../src/vendor/plupload-2.1.8/js/',
            css: '../src/vendor/plupload-2.1.8/js/',
            img: '../src/vendor/plupload-2.1.8/js/',
        },
    },
};
var dstbase = {
    http: dstapp+'Http/',
    libs: dstapp+'Libs/',
    models: dstapp+'Models/',
    resources: {
        views: {
            layouts: dstroot+'resources/views/layouts/',
            site: dstroot+'resources/views/site/',
            admin: dstroot+'resources/views/admin/',
            auth: dstroot+'resources/views/auth/',
        },
        assets: dstroot+'resources/assets/',
    },
    config: dstroot+'config/',
    css: dstroot+'/public/css/',
    appcss: dstroot+'/public/css/app/',
    appjs: dstroot+'/public/js/app/',
    img: {
        base: dstroot+'public/img/',
        plupload: dstroot+'public/img/plupload/',
    },
    vendor: {
        plupload: {
            js: dstroot+'/public/js/vendor/plupload/',
            css: dstroot+'/public/css/vendor/plupload/',
        },
    },
};
var srcfiles = {
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
    gulp.src(srcfiles.setup).pipe(gulp.dest(dstroot));
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
    gulp.src(srcbase.resources.views.admin+'/**/*.php',{base: srcbase.resources.views.admin}).pipe(gulp.dest(dstbase.resources.views.admin));
    gulp.src(srcbase.resources.views.auth+'/**/*.php',{base: srcbase.resources.views.auth}).pipe(gulp.dest(dstbase.resources.views.auth));
});
gulp.task('copylibs', ['init'], function() {
    gulp.src(srcbase.libs+'*.php').pipe(gulp.dest(dstbase.libs));
});
gulp.task('copymodels', ['init'], function() {
    gulp.src(srcbase.models+'*.php').pipe(gulp.dest(dstbase.models));
});
gulp.task('copyhttp', ['init'], function() {
    gulp.src(srcbase.http+'routes.php').pipe(gulp.dest(dstbase.http)); // routes
    gulp.src(srcbase.http+'Controllers/*.php').pipe(gulp.dest(dstbase.http+'Controllers/')); // base controller
    gulp.src(srcbase.http+'Controllers/Auth/*.php').pipe(gulp.dest(dstbase.http+'Controllers/Auth/'));
    gulp.src(srcbase.http+'Controllers/Site/*.php').pipe(gulp.dest(dstbase.http+'Controllers/Site/'));
    gulp.src(srcbase.http+'Controllers/Admin/*.php').pipe(gulp.dest(dstbase.http+'Controllers/Admin/'));
});
gulp.task('copycss', ['init'], function() {
    gulp.src(srcbase.appcss+'/**/*.css',{base: srcbase.appcss}).pipe(gulp.dest(dstbase.appcss));
});
gulp.task('copyjs', ['init'], function() {
    gulp.src(srcbase.appjs+'/**/*.js',{base: srcbase.appjs}).pipe(gulp.dest(dstbase.appjs));
});
gulp.task('copymeta', ['init'], function() {
    gulp.src(srcbase.meta+'configs/*.php').pipe(gulp.dest(dstbase.config));
});
gulp.task('copyplupload', ['init'], function() {
    gulp.src(srcbase.vendor.plupload.js+'*.js').pipe(gulp.dest(dstbase.vendor.plupload.js));
    gulp.src(srcbase.vendor.plupload.js+'Moxie.swf').pipe(gulp.dest(dstbase.vendor.plupload.js));
    gulp.src(srcbase.vendor.plupload.js+'Moxie.xap').pipe(gulp.dest(dstbase.vendor.plupload.js));
    gulp.src(srcbase.vendor.plupload.js+'jquery.ui.plupload/*.js').pipe(gulp.dest(dstbase.vendor.plupload.js));
    gulp.src(srcbase.vendor.plupload.css+'**/*.css')
        .pipe(gflatten())
        .pipe(gulp.dest(dstbase.vendor.plupload.css));
    gulp.src(srcbase.vendor.plupload.img+'**/{*.png,*.gif}')
        .pipe(gflatten())
        .pipe(gulp.dest(dstbase.css+'vendor/img'));
});
// group task to install all source
gulp.task('copysrc', ['copyhttp','copylibs','copymodels','copyresources','copycss','copyjs','copyplupload'], function() {
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


//=================================================
// WATCH
//=================================================
// %FIXME
gulp.task('watch', ['init'], function() {
    //gulp.watch('../src/**/*.php', ['copyhttp']);
    gulp.watch(srcbase.http+'**/*.php', ['copyhttp']);
    gulp.watch(srcbase.libs+'**/*.php', ['copylibs']);
    gulp.watch(srcbase.models+'**/*.php', ['copymodels']);
    gulp.watch(srcbase.src+'resources/**/*.php', ['copyresources']);
    gulp.watch(srcbase.appcss+'**/*.css', ['copycss']);
    gulp.watch(srcbase.appjs+'**/*.js', ['copyjs']);
});

gulp.task('default', ['watch']);
