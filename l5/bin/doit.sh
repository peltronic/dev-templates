
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
#   "require": {
#       "php": ">=5.5.9",
#       "laravel/framework": "5.2.*",
#       "laravelcollective/html": "^5.2",
#       "zizaco/entrust": "dev-laravel-5",
#       "sammyk/laravel-facebook-sdk": "^3.0"
#   },
# *** Manually Add to config/app.php providiers:
#  Collective\Html\HtmlServiceProvider::class,
#  Zizaco\Entrust\EntrustServiceProvider::class,
# *** Manually Add to config/app.php aliases:
#   'Form'      => Collective\Html\FormFacade::class,
#   'Html'      => Collective\Html\HtmlFacade::class,
#   'Entrust'   => Zizaco\Entrust\EntrustFacade::class,
#   'Input' => Illuminate\Support\Facades\Input::class,

# Manually set config/*.php files

# Manually update providers.user in config/app.php
#   'providers' => [
#       'users' => [
#           'driver' => 'eloquent',
##          'model' => App\User::class,
#           'model' => App\Models\User::class,
#       ],

# Zizaco Entrust bug fix
# manually update composer.json...
#https://github.com/Zizaco/entrust/issues/468

# => Manually update middleware for Entrust
# If you are going to use Middleware (requires Laravel 5.1 or later) you also need to add
#   'role' => \Zizaco\Entrust\Middleware\EntrustRole::class,
#   'permission' => \Zizaco\Entrust\Middleware\EntrustPermission::class,
#   'ability' => \Zizaco\Entrust\Middleware\EntrustAbility::class,
# to routeMiddleware array in app/Http/Kernel.php.

## OTHER:
## https://github.com/SammyK/LaravelFacebookSdk
## In .env:
#FACEBOOK_APP_ID    = ...
#FACEBOOK_APP_SECRET  = ...
