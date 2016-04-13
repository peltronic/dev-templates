<?php
namespace PsgAdmin;

// http://laravelbook.com/laravel-user-authentication/
// http://code.tutsplus.com/tutorials/authentication-with-laravel-4--net-35593
// http://scotch.io/tutorials/simple-and-easy-laravel-login-authentication
// http://stackoverflow.com/questions/3521290/logout-get-or-post

class AuthController extends BaseController {

    protected $_lmessages; // hack until we encapsualte this to its own class

    public function __construct()
    {
        $this->_lmessages = array();

        parent::__construct();

        // must be after parent call!
        $this->registerJsLibs([
            //'/js/site/libs/clSiteUtils.js',
         ]);
        $this->registerJsInlines([
            //'/js/site/initAuth.js',
         ]);
    }

    public function doLogout() {
        \Auth::logout();
        return \Redirect::route('admin.showlogin')->with('message', 'You are now logged out!');
    }

    public function showLogin()
    {
        if ( \Auth::user() ) {
            return \Redirect::route('admin.home');
        }
        return \View::make('admin::auth.login');
    }


    public function doLogin()
    {
        $user = null;

        $attrs = \Input::all();
        unset($attrs['_trackcode']);

        $rules = [
            'password'=>'required',
            'email'=>'required|email',
        ];

        $validator = \Validator::make($attrs, $rules);

        $response = ['is_ok'=>0];

        try {

            if ($validator->fails()) {

                $this->_lmessages = $validator->messages();
                throw new \Exception('Validation failed', CLEX_VALIDATION);

            } else {

                $credentials = [
                                'email' => $attrs['email'],
                                'password' => $attrs['password'],
                                'is_confirmed' => 1, // require confirmation to login
                               ];
                if ( \Auth::attempt($credentials) ) {
                    // login successful!
                    $user = \Auth::user();
                } else {        
                    $user = \User::where('email','=',$attrs['email'])->first();
                    if ( !empty($user) && !$user->is_confirmed ) {
                        throw new \Exception('Login failed', CLEX_UNCONFIRMED_ACCOUNT); // user exists but not confirmed
                    } else {
                        throw new \Exception('Login failed', CLEX_INVALID_CREDENTIALS);
                    }
                }
            }

        } catch (\Exception $e) {        

//throw $e;
            // validation not successful, send back to form 
            $ecode = $e->getCode();
            switch ($ecode) {
                case CLEX_VALIDATION:
                    $messages = $validator->messages();
                    $metaError = null;
                    break;
                case CLEX_INVALID_CREDENTIALS:
                    $messages = [];
                    $metaError = 'Incorrect username and/or password';
                    break;
                case CLEX_UNCONFIRMED_ACCOUNT:
                    $messages = [];
                    $metaError = 'Account has not been confirmed. Please check your email inbox for confirmation email.';
                    break;
                default:
                    $metaError = $e->getMessage();
            }
            if (!\Request::ajax()) {
                if ( !empty($metaError) ) {
                    \Session::set('meta_error',$metaError);
                }
                return \Redirect::back()
    	                    ->withErrors($validator)
    	                    ->withInput(\Input::except('password'));
            } else {
                $response = ['is_ok'=>0,'messages'=>$messages,'meta_errors'=>[$metaError]];
                return \Response::json($response);
            }
        } // try-catch

        $redirectURL = route('admin.home');

        if (!\Request::ajax()) {
            return \Redirect::to($redirectURL);
        } else {
            unset($user->password);
            $response = [ 'is_ok'=>1, 'redirect_url'=>$redirectURL, 'obj'=>$user ];
            return \Response::json($response);
        }
    } // doLogin()


}
