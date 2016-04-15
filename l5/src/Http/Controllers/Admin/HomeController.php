<?php

namespace UtAdmin;

class HomeController extends BaseController {

	public function __construct()
	{
//$ig = \Auth::user();
//dd('home:'.$ig);
        parent::__construct();

	}

	public function index()
	{
        $data = [];
		return \View::make('admin::home.index',$data);
	}
}
