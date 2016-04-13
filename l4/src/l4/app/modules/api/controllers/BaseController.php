<?php
namespace PsgApi;

class BaseController extends \Controller {

    protected $_modelClass;

    public function __construct()
    {
        if (\Request::ajax()) {
            //throw new Exception('AJAX only');
        }
    }


    /*
	public function store()
	{
        $MODELCLASS = $this->_modelClass; 
    	$obj = $MODELCLASS::create(\Input::all());
	}

	public function update($id)
	{
        $obj = $MODELCLASS::findOrFail($id);
        $obj->fill( \Input::all() );
        $obj->save();
	}


	public function index()
	{
		//
	}

	public function create()
	{
	}
	public function show($id)
	{
		//
	}
	public function edit($id)
	{
		//
	}



	public function destroy($id)
	{
		//
	}
     */


}
