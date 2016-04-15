#!/bin/bash

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
# 
#=======================
mysql -u root -pdenshi51 < ${ROOTDIR}/sql/base.sql
if [ "$?" != "0" ]; then
    error_exit "$LINENO: SQL base database creation failed"
fi
mysql -u root -pdenshi51 < ${ROOTDIR}/sql/app.sql
if [ "$?" != "0" ]; then
    error_exit "$LINENO: SQL app database creation failed"
fi
mysql -u root -pdenshi51 < ${ROOTDIR}/sql/entrust.sql
if [ "$?" != "0" ]; then
    error_exit "$LINENO: SQL entrust database creation failed"
fi
mysql -u root -pdenshi51 < ${ROOTDIR}/sql/devuser.sql
if [ "$?" != "0" ]; then
    error_exit "$LINENO: SQL user set privileges failed"
fi
