<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable {

    use EntrustUserTrait; 

	protected $table = 'users';

	protected $hidden = ['password', 'remember_token'];

    protected $fillable = [
                            'email',
                            'username',
                            'password',
                            'password_confirmation',
                            'firstname',
                            'lastname',
                            'about',
                            'remember_token',
                            'is_confirmed',
                            'confirmation_code',
                          ];

    public static $rules = [
        'username'=>'required|alpha_num|unique:username',
        'email'=>'required|email|unique:users',
        'password'=>'required|min:8',
        //'password'=>'required|min:8|confirmed',
        //'password_confirmation'=>'sometimes',
        'firstname'=>'alpha_dash_space',
        'lastname'=>'alpha_dash_space',
        //'remember_token'=>'required',
    ];

    public static function getUser($userId=null)
    {
        if ( !empty($userId) ) {
            $user = \User::select('id','name','email')->find($userId);
        } else if ( \Auth::guest()) {
            $user = null;
        } else {
            $user = \Auth::user();
            unset($user->password);
        }
        return $user;
    }

    public function getRoleNames()
    {
        $results = [];
        $roles = $this->roles;
        foreach ($roles as $r) {
            $results[] = $r->name;
        }
        return $results;
    }

    public static function getValidationRules($isLogin=1) 
    {
        $rules = self::$rules;
        if ($isLogin) {
            unset($rules['password_confirmation']);
            $rules['password'] = 'required|min:8';
        }
        return $rules;
    }

    // %%% ---

    public function roles()
    {
        return $this->belongsToMany('\App\Models\Role');
    }
}
