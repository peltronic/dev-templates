#!/bin/bash

# I put a variable in my scripts named PROGNAME which
# holds the name of the program being run.  You can get this
# value from the first item on the command line ($0).

: "${BUILDDIR:?Env variable BUILDDIR must be set}"
PROGNAME=$(basename $0)


#-------------------------------------------------------------
# Function for exit due to fatal program error
#   Accepts 1 argument: string containing descriptive error message
#----------------------------------------------------------------
function error_exit
{
    echo "ERROR.fatal - ${PROGNAME}: ${1:-"Unknown Error"}" 1>&2
    exit 1
}

#=======================
# INSTALL LARAVEL
#=======================
CWD=$(pwd)
cd $BUILDDIR
echo "=> INSTALLING L5 in $(pwd)..."
php -n ~/bin/composer.phar create-project --prefer-dist laravel/laravel myl5app
if [ "$?" != "0" ]; then
    error_exit "$LINENO: Laravel install failed"
fi
cd $CWD

#=======================
# Create symlink
#=======================
CWD=$(pwd)
cd $BUILDDIR
cd ..
ln -s current www
cd $CWD
exit 0

#=======================
# Set folder permissions
#=======================
chmod -R 777 ./storage
chmod -R 777 bootstrap/cache

#=======================
# Install packages
#=======================
CWD=$(pwd)
cd $BUILDDIR/myl5app
php -n ~/bin/composer.phar require laravelcollective/html
php -n ~/bin/composer.phar require zizaco/entrust
php -n ~/bin/composer.phar require facebook/php-sdk-v4
php -n ~/bin/composer.phar update
cd $CWD
exit 0

# [ ] do an initial git push before running gulpfile

# ------------------------------------
# ------------------------------------
# ------------------------------------

# [ ] source .env
# [ ] update configs
# [ ] fix .htaccess
# [ ] UPDATE config/app.php providers & alises (!)
# see ~/Dev/consulting/uwc/l5/petergwebdev

#=======================
# Create symlink
#=======================
cd myl5app
# [ ] update .env, .htaccess, etc
\cp -f $ROOTDIR/src/{.env,.htaccess} ./
if [ "$?" != "0" ]; then
    error_exit "$LINENO: Could not install .env"
fi


exit 0  # DEBUG

# ***Add to config/app.php providiers:
#  Collective\Html\HtmlServiceProvider::class,
#  Zizaco\Entrust\EntrustServiceProvider::class,
# ***Add to config/app.php aliases:
#   'Form'      => Collective\Html\FormFacade::class,
#   'Html'      => Collective\Html\HtmlFacade::class,
#   'Entrust'   => Zizaco\Entrust\EntrustFacade::class,

# https://laravel.com/docs/5.1/elixir#installation
# http://stackoverflow.com/questions/30964780/foundation-with-laravel-and-elixir 
# [ ] touch .bowerrc # add content (use cp)
# [ ] touch bower.json # add content (use cp)
# [ ] npm install --global bower
# [ ] bower install # This will install Foundation into vendor/bower_components
# [ ] touch resources/assets/sass/_settings.scss # add content (use cp)
# [ ] edit resources/assets/sass/app.scss # add content (NOTE this is an edit, file exists)
# [ ] edit gulpfile.js # add content
# [ ] npm install # Install L5 elixir
# [ ] gulp
## To update to the latest Zurb Foundation version run:
## [ ] bower update

mysql -u root -pdenshi51 < sql/base.sql
if [ "$?" != "0" ]; then
    error_exit "$LINENO: SQL database creation failed"
fi

cp $ROOTDIR/src/models/*.php ./app/models
if [ "$?" != "0" ]; then
    error_exit "$LINENO: Model installation failed"
fi

cp $ROOTDIR/src/Http/routes.php ./app/Http/
cp -R $ROOTDIR/src/Http/Controllers/Site ./app/Http/Controllers/
cp -R $ROOTDIR/src/resources/views/site  ./resources/views/
cp -R $ROOTDIR/src/resources/views/layouts  ./resources/views/


#php -n init-app-composer.php
#if [ "$?" != "0" ]; then
#    error_exit "$LINENO: Composer modification failed"
#fi

#php -n -d extension=mcrypt.so artisan workbench psgconsulting/Formbuilder --resources
#if [ "$?" != "0" ]; then
#    error_exit "$LINENO: Formbuilder installed failed"
#fi

# ---
# https://github.com/Zizaco/entrust
# Then in your config/app.php add
# Zizaco\Entrust\EntrustServiceProvider::class,
# in the providers array and
#'Entrust'   => Zizaco\Entrust\EntrustFacade::class,
# to the aliases array.
#
# If you are going to use Middleware (requires Laravel 5.1 or later) you also need to add
#   'role' => \Zizaco\Entrust\Middleware\EntrustRole::class,
#   'permission' => \Zizaco\Entrust\Middleware\EntrustPermission::class,
#   'ability' => \Zizaco\Entrust\Middleware\EntrustAbility::class,
# to routeMiddleware array in app/Http/Kernel.php.
# ... more... see link

