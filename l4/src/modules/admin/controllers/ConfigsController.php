<?php

namespace PsgAdmin;

class ConfigsController extends BaseController {

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

		return \View::make('admin::configs.index',['data'=>$data]);
	}

	public function show($pkid)
	{
        $data = [];
        $data['obj'] = $obj = \Siteconfig::findOrFail($pkid);

        $this->_routes['crud_edit'] = ['route'=>'admin.configs.edit','params'=>$pkid,'title'=>'Edit'];
        \View::share('g_routes', $this->_routes);

		return \View::make('admin::configs.show',$data);
	}

    // Crud (GET)
    public function edit($pkid)
    {
        $data = [];
        $obj = \Siteconfig::findOrFail($pkid);
        $obj->url = \Psg\Utils::fillUrlFromDomain($obj->url);
        $data['obj'] = $obj;

        $this->_routes['crud_show'] = ['route'=>'admin.configs.show','params'=>$pkid,'title'=>'Show'];
        \View::share('g_routes', $this->_routes);

        return \View::make('admin::configs.edit', $data);
    } // edit()

    // Crud (PUT)
    public function update($pkid)
    {
        $attrs = \Input::all();
        $data = [];

        try {

            $data['obj'] = $obj = \Siteconfig::findOrFail($pkid);

            $rules = \Siteconfig::getValidationRules();
            unset($rules['slug']);
            $validator = \Validator::make($attrs, $rules);

            if ($validator->fails()) {
                throw new \Exception('Validation failed', CLEX_VALIDATION);
            }

            $obj = \DB::transaction(function() use($attrs, $obj) {
                $obj->fill($attrs);
                $obj->save();
                return $obj;
            });

        } catch (\Exception $e) {
            $ecode = $e->getCode();
            switch ($ecode) {
                case CLEX_VALIDATION:
                    $messages = $validator->messages();
                    $metaErrors = [];
                    break;
                default:
                    $messages = [];
                    $metaErrors = [$e->getMessage()];
            }
            return \Redirect::back()->withErrors($validator)->withInput();
        }

        return \Redirect::route('admin.configs.show',$obj->id);

    } // update()


}
