<?php
namespace PsgSite;

class RemindersController extends BaseController {

    public function __construct()
    {
        parent::__construct();
    }

    public function getForgot()
    {
        if ( \Auth::user() ) {
            return \Redirect::route('site.dashboard.index'); // session exists
        }

        return \View::make('site::reminders.remindForm');
    }

    public function getTokensentConfirm()
    {
        if ( \Auth::user() ) {
            return \Redirect::route('site.dashboard.index'); // session exists
        }

        return \View::make('site::reminders.tokensent_confirm');
    }

    public function postForgot()
    {
        $attrs = \Input::only( 'email' );
        $rules = ['email'=>'required|email'];
        $validator = \Validator::make($attrs, $rules);

        try {
            if ($validator->fails()) {
                throw new \Exception('Validation failed', CLEX_VALIDATION);
            }

            // Make sure user exists
            $user = \User::where('email','=',$attrs['email'])->first();

            if (empty($user)) {
                throw new \Exception('Invalid email');
            }
            unset($user->password);
            
        } catch (\Exception $e) { 
            $code = $e->getCode();
            if ($code == CLEX_VALIDATION) {
                return \Redirect::back()->withErrors($validator)->withInput();
            } else {
                return \Redirect::back()->withErrors([$e->getMessage()])->withInput();
            }
        }

        // Validation succeeded
        $response = \Password::remind(\Input::only('email'), function($message) {
            $message->subject('[clssfy] Reset Password');
        });
        switch ($response) {
            case \Password::INVALID_USER:
                return \Redirect::back()->with('error', \Lang::get($response));

            case \Password::REMINDER_SENT:
                return \Redirect::route('site.password.getTokensentConfirm');
        }
    }

    // eg: http://www.dev-ravecoder.com/password/reset/6e074ab821307d4b010b4f69d0519a0aa6e5cc7c
    public function getReset($token = null)
    {
        if ( \Auth::user() ) {
            return \Redirect::route('site..dashboard.index'); // session exists
        }

        if (is_null($token)) {
            \App::abort(404);
        }

        // Check for valid token
        $pswdReminder = \DB::table('password_reminders')
                            ->where('token','=',$token)
                            ->first();
        if (is_null($pswdReminder)) {
            \App::abort(404);
        }

        return \View::make('site::reminders.resetForm')->with('token', $token);
    }

    public function postReset()
    {
        $attrs = \Input::only( 'email', 'password', 'password_confirmation', 'token');
        $rules = ['email'=>'required|email','password'=>'required|min:8|confirmed'];
        $validator = \Validator::make($attrs, $rules);

        try {
            if ($validator->fails()) {
                throw new \Exception('Validation failed', CLEX_VALIDATION);
            }

            // %FIXME: created_at is UTC
            $pswdReminder = \DB::table('password_reminders')
                                ->where('email','=',$attrs['email'])
                                ->where('token','=',$attrs['token'])
                                //->where('created_at','>', \DB::raw('DATE_SUB(NOW(), INTERVAL 1 HOUR)') ) // within last hour
                                ->where('created_at','>', \DB::raw('DATE_SUB(UTC_TIMESTAMP(), INTERVAL 1 HOUR)') ) // within last hour
                                ->first();

            // delete regardless
            \DB::table('password_reminders')
                                ->where('email','=',$attrs['email'])
                                ->where('token','=',$attrs['token'])
                                ->delete();

            if (empty($pswdReminder)) {
                throw new \Exception('Invaid token');
            }

            $user = \User::where('email','=',$attrs['email'])->firstOrFail();
            $user->password = \Hash::make($attrs['password']);
            $user->save();

            unset($user->password);
            
        } catch (\Exception $e) { 
            $code = $e->getCode();
            if ($code == CLEX_VALIDATION) {
                return \Redirect::back()->withErrors($validator)->withInput();
            } else {
                return \Redirect::back()->withErrors([$e->getMessage()])->withInput();
            }
        }

        // Successful password reset
        return \Redirect::route('site.showlogin')->with('message','Your password has been successfully reset. Please login with new password.');
    }

}
        // %FIXME: call this, but send mail manually as well since this isn't working
/*
        \Mail::send('emails.welcome', ['token' => 'foo'], function($message)
        {
            $message->to('peter@peltronic.com', 'Peter Test')->subject('Welcome!');
        });
 */
        /*
        $to = 'peter@peltronic.com';
        $subject = 'test 123';
        $message = 'body test 123';
        $isOK = mail ( $to , $subject , $message );
         */
