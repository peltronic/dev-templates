<?php
namespace PsgSite;

class HomeController extends BaseController {

    public function __construct()
    {
        parent::__construct();

        // must be after parent call!
        $this->registerJsLibs([
         ]);
        $this->registerJsInlines([
         ]);
    }


	public function show()
	{
        $data = [];
        \View::share('g_body_tag', 'home');
        return \View::make('site::home/index',$data);
	} // show()


}
