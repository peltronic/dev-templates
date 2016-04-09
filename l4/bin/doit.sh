#!/bin/bash

$ php -n  ~/bin/composer.phar create-project laravel/laravel myl4app 4.2 --prefer-dist

$ cd myl4app
$ php -n -d extension=mcrypt.so artisan workbench psgconsulting/Formbuilder --resources
