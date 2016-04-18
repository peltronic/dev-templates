<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Libs\Crudtable;

class SiteconfigsController extends AdminController {

    protected $_routes; // %FIXME: move to a composed object

	public function __construct()
	{
        parent::__construct();

        $this->registerJsInlines([
         ]);

        // Common sidebar routes
        $this->_routes['crud_index'] = ['route'=>'admin.configs.index','title'=>'List'];
	}

	public function index()
	{
        //$this->_routes['do_export'] = ['route'=>'admin.subscribers.doExport','title'=>'Export'];
        //\Input::flash();

        \View::share('g_routes', $this->_routes);

        $data = [];

        $crudTable = new Crudtable('siteconfigs',['slug','value']);
        $q = $crudTable->makeQuery();
        $crudTable->applyFilters($q); // updates $q

        $data['crud_table'] = &$crudTable;
        $data['cnt'] = $q->count();
        $data['records'] = $records = $q->paginate(25);

        return \View::make('admin.siteconfigs.index',$data);
	}
}
