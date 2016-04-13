<?php

namespace PsgAdmin;

class UsersController extends BaseController {

	public function __construct()
	{
        parent::__construct();

        // Common sidebar routes
        $this->_routes['crud_index'] = ['route'=>'admin.users.index','title'=>'Users'];
	}

	public function index()
	{
        // Sidebar routes
        //$this->_routes['do_export'] = ['route'=>'admin.users.doExport','title'=>'Export'];
        
        \View::share('g_routes', $this->_routes);

        \Input::flash();

        $data = [];
        $crudTable = new \Psg\Crudtable('users',['email']);
        $q = $crudTable->makeQuery();
        $crudTable->applyFilters($q); // updates $q

        $data['crud_table'] = &$crudTable;
        $data['cnt'] = $q->count();
        $data['records'] = $records = $q->paginate(25);

		return \View::make('admin::users.index',['data'=>$data]);
	}

	public function show($pkid)
	{
        $user = \User::findOrFail($pkid);

        // Sidebar routes
        $this->_routes['change_password'] = ['route'=>'admin.users.editPassword','title'=>'Change Password','params'=>[$pkid]];

        \View::share('g_routes', $this->_routes);

		return \View::make('admin::users.show',['user'=>$user]);
	}

	public function editPassword($userID)
    {
        $user = \User::findOrFail($userID);
        \View::share('g_routes', $this->_routes);
        return \View::make('admin::users/edit_password')->with('user',$user);
    }

	public function updatePassword($userID)
    {
        $user = \User::findOrFail($userID);

        $response = null;

        $attrs = [];
        $attrs['password'] = \Input::get('password');
        $attrs['password_confirmation'] = \Input::get('password_confirmation');

        $rules = [];
        $rules['password'] = 'required|confirmed|min:8';
        $validator = \Validator::make($attrs, $rules);

        try {
            if ($validator->fails()) {
                throw new \Exception('Validation failed', CLEX_VALIDATION);
            }

            $user = \DB::transaction(function() use($attrs,$user) {
                $user->password = \Hash::make($attrs['password']);
                $user->save();
                unset($user->password);
                unset($user->remember_token);
                return $user;
            });

            $response = ['is_ok'=>1,'obj'=>$user];

        } catch (\Exception $e) {
            $code = $e->getCode();
            if ($code == CLEX_VALIDATION) {
                $messages = $validator->messages();
            } else {
                $messages = [$e->getMessage()];
            }
            $response = ['is_ok'=>0,'messages'=>$messages];
        }

        if (\Request::ajax()) {
            return \Response::json($response);
        } else {
            if ($response['is_ok']) {
                return \Redirect::route('admin.users.show',[$user->id]);
            } else {
                return \Redirect::back()->withErrors($validator)->withInput(); // %FIXME: merge errors
            }
        }    

    } // updatePassword($userID)

    /*
	public function loginAsUser($userID)
	{
        \Auth::loginUsingId($userID);
        return \Redirect::route('admin.home');
	}
     */

}
