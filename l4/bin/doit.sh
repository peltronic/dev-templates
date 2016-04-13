#!/bin/bash

# I put a variable in my scripts named PROGNAME which
# holds the name of the program being run.  You can get this
# value from the first item on the command line ($0).

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

#php -n  ~/bin/composer.phar create-project laravel/laravel myl4app 4.2 --prefer-dist
php -n ~/bin/composer.phar create-project --prefer-dist laravel/laravel myl5app
if [ "$?" != "0" ]; then
    error_exit "$LINENO: Laravel install failed"
fi

cd myl4app
if [ "$?" != "0" ]; then
    error_exit "$LINENO: Could not cd to L4 app"
fi

# [ ] update .env, .htaccess, etc
\cp -f $ROOTDIR/src/{.env,.htaccess} ./
if [ "$?" != "0" ]; then
    error_exit "$LINENO: Could not install .env"
fi

#chmod -R 777 bootstrap/cache
# [ ] update configs
# [ ] fix .htaccess
# [ ] chmod -R 777 ./storage
# [ ] UPDATE config/app.php providers & alises (!)
# see ~/Dev/consulting/uwc/l5/petergwebdev
chmod -R 777 ./storage
if [ "$?" != "0" ]; then
    error_exit "$LINENO: Could not chmod 777 storage"
fi
# [ ] source .env

exit 0  # DEBUG


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

composer require laravelcollective/html

#php -n init-app-composer.php
#if [ "$?" != "0" ]; then
#    error_exit "$LINENO: Composer modification failed"
#fi

#php -n -d extension=mcrypt.so artisan workbench psgconsulting/Formbuilder --resources
#if [ "$?" != "0" ]; then
#    error_exit "$LINENO: Formbuilder installed failed"
#fi

