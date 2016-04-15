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

npm install

cd $CWD
exit 0


# ------------------------------------
# ------------------------------------
# ------------------------------------

# [ ] source .env
# [ ] update configs
# [ ] fix .htaccess
# [ ] UPDATE config/app.php providers & alises (!)
# see ~/Dev/consulting/uwc/l5/petergwebdev

#=======================
# ...
#=======================
cd myl5app
# [ ] update .env, .htaccess, etc
\cp -f $ROOTDIR/src/{.env,.htaccess} ./
if [ "$?" != "0" ]; then
    error_exit "$LINENO: Could not install .env"
fi

# [ ] do an initial git push before running gulpfile
# [ ] Run  gulp --BUILDDIR=$BUILDDIR copysrc

exit 0  # DEBUG

# ***Add to config/app.php providiers:
#  Collective\Html\HtmlServiceProvider::class,
#  Zizaco\Entrust\EntrustServiceProvider::class,
# ***Add to config/app.php aliases:
#   'Form'      => Collective\Html\FormFacade::class,
#   'Html'      => Collective\Html\HtmlFacade::class,
#   'Entrust'   => Zizaco\Entrust\EntrustFacade::class,

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


