<?php

namespace App\Http\Controllers\Site;

//use App\User;
use Validator;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function __construct()
    {
    }

    public function show()
    {
//$env = \App::environment();
        //dd($env);
        dd('here I am');
    }

}
