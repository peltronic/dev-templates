<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class HomeController extends Controller {

	public function __construct()
	{
//$ig = \Auth::user();
//dd('home:'.$ig);
        parent::__construct();

	}

	public function index()
	{
        $data = [];
        return \View::make('admin.home.index',$data);
	}
}
