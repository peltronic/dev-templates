
source setenv.sh
pushd bin

sh ./install-l5.sh
sh ./install-sql.sh

# [ ] do an initial git push before running gulpfile

gulp --BUILDDIR=$BUILDDIR copysrc

gulp --BUILDDIR=$BUILDDIR setup-foundation
sh ./install-foundation.sh
gulp --BUILDDIR=$BUILDDIR install-foundation

popd

# L5 local gulp
#   http://stackoverflow.com/questions/30964780/foundation-with-laravel-and-elixir

pushd builds/current/myl5app

# Run all tasks...
gulp 

# Run all tasks and minify files
gulp --production 

# Watch for changes and run all tasks on the fly
gulp watch 

popd

# Your compiled files will be at public/css/app.css and public/js/app.js.

# *** Manually Add to config/app.php providiers:
#  Collective\Html\HtmlServiceProvider::class,
#  Zizaco\Entrust\EntrustServiceProvider::class,
# *** Manually Add to config/app.php aliases:
#   'Form'      => Collective\Html\FormFacade::class,
#   'Html'      => Collective\Html\HtmlFacade::class,
#   'Entrust'   => Zizaco\Entrust\EntrustFacade::class,
#   'Input' => Illuminate\Support\Facades\Input::class,

# Manually set config/*.php files
