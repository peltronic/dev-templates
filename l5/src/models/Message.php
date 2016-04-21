<?php namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

class Message extends BaseModel {

    //--------------------------------------------
    // Setup
    //--------------------------------------------
    protected $fillable = [ 'slug', 'user_id', 'title','content'];

    public static $rules = [
        'user_id' => 'required|integer',
    ];

    //--------------------------------------------
    // Relations
    //--------------------------------------------
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function mediafiles()
    {
        return $this->hasMany('App\Models\Mediafile');
    }


}
