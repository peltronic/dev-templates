<?php
namespace App\Http\Controllers\Site;

//use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\SiteController;

use App\User;
use Validator;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use SammyK\LaravelFacebookSdk\LaravelFacebookSdk;

class AuthController extends \App\Http\Controllers\Auth\AuthController {

    public function __construct()
    {
        parent::__construct();
    }

    // --- Facebook ---

    // http://maxoffsky.com/code-blog/integrating-facebook-login-into-laravel-application/
    public function doFacebookLogin()
    {
        //$fb = new LaravelFacebookSdk(\Config::get('facebook'));
        //$fb = new LaravelFacebookSdk();
        //$fb = \App::make('SammyK\LaravelFacebookSdk\LaravelFacebookSdk');
        //$fb = app(SammyK\LaravelFacebookSdk\LaravelFacebookSdk::class);
        $fb = app(LaravelFacebookSdk::class);
        
        return \Redirect::to($fb->getLoginUrl(['email']));
        /*
        $facebook = new \Facebook(\Config::get('facebook'));
        $params = [
                    'redirect_uri' => url('/login/fb/callback'),
                    'scope' => 'email',
                  ];
        $login_url = $fb->getLoginUrl(['email']);
        return \Redirect::to($facebook->getLoginUrl($params));
         */

    } // doFacebookLogin()


    public function callbackFacebookLogin()
    {
        //$mp = \Mixpanel::getInstance(MIXPANEL_TOKEN);

        try {
            $code = \Input::get('code');
            if (strlen($code) == 0) {
                throw new \Exception('There was an error communicating with Facebook', EX_FB_ERROR);
            }
        
            $facebook = new \Facebook(\Config::get('facebook'));
            $uid = $facebook->getUser();
        
            if ($uid == 0) {
                throw new \Exception('There was an error communicating with Facebook', EX_FB_ERROR);
            }
        
            $me = $facebook->api('/me?fields=email,name,first_name,last_name,picture');
            //$me = $facebook->api('/me/photos');

            $profile = \Profile::whereUid($uid)->first();

            if ( !empty($profile) ) {
                 
                // Facebook LOGIN (already registered & confirmed)
                $user = $profile->user;

                // Log them in if already confirmed: normal login
                \Auth::login($user);
                if ( !\Auth::check() ) {
                    throw new \Exception('Could not login via Facebook', EX_FB_LOGIN);
                }
                $redirectURL = route('site.dashboard.index');

            } else {

                // Facebook REGISTER
        
                list($user,$isExisting) = \DB::transaction(function() use($me,$uid,$facebook) {

                    // Setup [users] record

                    $user = \User::where('email','=',$me['email'])->first();
                    if ( empty($user) ) {
                        // New
                        $isExisting = 0;
                        $user = new \User; // create new user account
                        $user->firstname = $me['first_name'];
                        $user->lastname = $me['last_name'];
                        $user->email = $me['email'];
                        $user->is_confirmed = 1;
                        $user->confirmation_code = NULL;
                        $user->save();

                        // Need to do this *after* user save so we have the user id
                        $reader = \Role::where('name','=','Reader')->firstOrFail();
                        $writer = \Role::where('name','=','Writer')->firstOrFail();
                        //$editor = \Role::where('name','=','Editor')->first(); %FIXME: later
                        $user->attachRole( $reader );
                        $user->attachRole( $writer );
                    } else {
                        // Exists: merge
                        $isExisting = 1;
                        $user->firstname = empty($user->firstname) ? $me['first_name'] : $user->firstname;
                        $user->lastname = empty($user->lastname) ? $me['last_name'] : $user->lastname;
                        //$user->email = $me['email']; -- already matches
                        $user->save();
                    }

                    // Setup [profiles] record
                    $profile = new \Profile;
                    $profile->fbemail = $me['email'];
                    $profile->uid = $uid;
                    $profile->access_token = $facebook->getAccessToken();
                    //$profile->username = $me['username'];
                    //$photo->photo = 'https://graph.facebook.com/'.$me['username'].'/picture?type=large';
                    $profile = $user->profiles()->save($profile);
    
                    $profile->save();

                    return [$user,$isExisting];
                });

                if ( $user->is_confirmed ) {
                    if ($isExisting) {
                        // send nothing
                    } else {
                        $user->sendVerifyEmail('emails.auth.welcome');
                    }
                    // Log them in if already confirmed: normal login
                    \Auth::login($user);
                    if ( !\Auth::check() ) {
                        throw new \Exception('Could not login via Facebook', EX_FB_LOGIN);
                    }
                    $redirectURL = route('site.dashboard.index');
                } else {  // not confirmed
                    if ($isExisting) { // not confirmed but existing user (merge case)
                        $user->sendVerifyEmail('emails.auth.verify-fbmerge');
                    } else { // not confirmed & new user 
                        $user->sendVerifyEmail('emails.auth.verify');
                    }
                    \Auth::logout();
                    \Session::flash('message','Please check your email for the account activation link.');
                    $redirectURL = route('site.showlogin');
                }

            } // if-else ( !empty($profile) )
        

        } catch (\Exception $e) {        

            // validation not successful, send back to form 
            $ecode = $e->getCode();
throw ($e);
            if ($ecode == EX_VALIDATION) {
                return \Redirect::back()->withErrors($validator)->withInput(\Input::except('password'));
            } else if ($ecode == EX_FB_LOGIN) {
                return \Redirect::back()->withErrors([$e->getMessage()]);
            } else if ($ecode == EX_FB_ERROR) {
                return \Redirect::back()->withErrors([$e->getMessage()]);
            } else {
                return \Redirect::back()->withErrors([$e->getMessage()])->withInput(\Input::except('password'));
            }

        } // try-catch

        return \Redirect::to($redirectURL);

    } // callbackFacebookLogin()

}
