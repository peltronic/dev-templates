<?php
namespace App\Http\Controllers;

class AdminController extends Controller {

    public function __construct()
    {
        parent::__construct();

        // common to all site controllers
        $this->registerJsLibs([
            //'/js/vendor/app.js',
            '//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js',
            '//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js',
         ]);

        $this->registerCssInlines([
            '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css',
            '//fonts.googleapis.com/css?family=Lato:100,300,400,700',
            '//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css',
            '/css/app/common/base.css',
            '/css/app/admin/styles.css',
         ]);

    }

}
