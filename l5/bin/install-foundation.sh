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
# Install foundation via bower
#=======================

CWD=$(pwd)
cd $BUILDDIR/myl5app

npm install --global bower

# Install Foundation into vendor/bower_components
bower install 
if [ "$?" != "0" ]; then
    error_exit "$LINENO: Bower install (foundation) failed"
fi
cd $CWD
exit 0

# [ ] Run  gulp --BUILDDIR=$BUILDDIR install-foundation

# https://laravel.com/docs/5.1/elixir#installation
# http://stackoverflow.com/questions/30964780/foundation-with-laravel-and-elixir 
# [ ] touch .bowerrc # add content (use cp)
# [ ] touch bower.json # add content (use cp)
#...
# [ ] touch resources/assets/sass/_settings.scss # add content (use cp)
# [ ] edit resources/assets/sass/app.scss # add content (NOTE this is an edit, file exists)
# [ ] edit gulpfile.js # add content
# [ ] npm install # Install L5 elixir
# [ ] gulp

## To update to the latest Zurb Foundation version run:
## [ ] bower update
