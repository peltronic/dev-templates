<?php
namespace PsgSite;

class UsersController extends BaseController {

    protected $_lmessages;

    public function __construct()
    {
        $this->_lmessages = array();
        parent::__construct();

        /*
        if ( !\Auth::user()->can('manage_users') ) {
            \App::abort(403, 'Unauthorized action');
        }
         */
    }

    // Crud (POST) : override base class
    public function store()
    {
        $attr = \Input::all();
        $attr['user_id'] = \Auth::user()->id;
        $rules = \User::getValidationRules();
        unset($rules['password']);
        $validator = \Validator::make($attr, $rules);

        try {
            if ($validator->fails()) {
                $this->_lmessages = $validator->messages();
                throw new \Exception('Validation failed', BBEX_VALIDATION);
            }
            $user = \DB::transaction(function() use($attr) {
			    $user = \User::findOrFail($attr['user_id']);
                unset($user->password);
                $user->fill( $attr ); // mass assignment
                $user->save();
                return $user;
            });
            $isOK = 1;
        } catch (\Exception $e) { 
            $isOK = 0;
            $code = $e->getCode();
            if ($code == BBEX_VALIDATION) {
                $messages = $this->_lmessages;
                $this->_lmessages = array();
            } else {
                $messages = array($e->getMessage());
            }
        }

        if (\Request::ajax()) {
            if ($isOK) {
                $response = array('is_ok'=>1,'user'=>$user);
            } else {
                $response = array('is_ok'=>0,'messages'=>$messages);
            }
            return \Response::json($response);
        } else {
            if ($isOK) {
                return \Redirect::back()->with('message','Success!');
            } else {
                return \Redirect::back()->withErrors($messages)->withInput();
            }
        }
    } // store()

}
