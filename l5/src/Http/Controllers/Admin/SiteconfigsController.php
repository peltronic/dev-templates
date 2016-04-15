<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class SiteconfigsController extends Controller {

    protected $_routes; // %FIXME: move to a composed object

	public function __construct()
	{
        parent::__construct();

        $this->registerJsInlines([
         ]);

        // Common sidebar routes
        $this->_routes['crud_index'] = ['route'=>'admin.configs.index','title'=>'Index'];
	}

	public function index()
	{
        $data = [];
        /*
        \View::share('g_routes', $this->_routes);

        $attrs = \Input::all();
        \Input::flash();

        $data['cnt'] = \DB::table('siteconfigs')->count();

        $q = \Siteconfig::orderBy('created_at','desc');
        $filters = ['slug'];
        foreach ($filters as $f) {
            if ( array_key_exists($f,$attrs) && !empty($attrs[$f]) ) {
                switch ($f) {
                    default:
                        $q->where($f,'LIKE','%'.$attrs[$f].'%');
                }
            }
        }

        $data['configs'] = $configs = $q->paginate(100);
        $data['cnt'] = $q->count();
         */

        return \View::make('admin.siteconfigs.index',$data);
	}

}
