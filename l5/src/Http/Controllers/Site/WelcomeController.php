<?php
namespace App\Http\Controllers\Site;

use App\Http\Controllers\SiteController;

class WelcomeController extends SiteController {

    public function __construct()
    {
        parent::__construct();
    }

    public function show()
    {
        $data = [];
        return \View::make('site.welcome.show',$data);
    }

}
