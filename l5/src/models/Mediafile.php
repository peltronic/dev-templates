<?php namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

class Mediafile extends BaseModel {

    //--------------------------------------------
    // Setup
    //--------------------------------------------
    protected $fillable = [ 'message_id', 'mimetype', 'ext','ogfilename', 'guid', 'caption'];

    public static $rules = [
        'message_id' => 'required|integer',
        'guid' => 'required|alpha_dash',
        //'ogfilename' => 'required|alpha_dash',
        'ogfilename' => 'required|regex:/^[a-zA-Z][a-zA-Z0-9\-\_\.]*\Z/',
    ];

    //--------------------------------------------
    // Relations
    //--------------------------------------------
    public function message()
    {
        return $this->belongsTo('App\Models\Message');
    }

    //--------------------------------------------
    // Custom Methods
    //--------------------------------------------

    //if ( \Input::hasFile('mediafile') )
    public static function savePLU($attrs,$belongsTo=null)
    {
        //$attrs = \Input::all();

            //$this->doPluUpload();

        $attrs['guid'] = $guid = \App\Libs\Guid::create();
        $attrs['ogfilename'] = $ogfilename = \Input::file('mediafile')->getClientOriginalName();
        $attrs['ext'] = $ext = pathinfo($ogfilename, PATHINFO_EXTENSION);

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $attrs['mimetype'] = $mimetype = finfo_file($finfo, \Request::file('mediafile'));
        finfo_close($finfo);
    
        $mediafile = new Mediafile($attrs);
        if ( empty($belongsTo) ) {
            $mediafle->save();
        } else {
            $belongsTo->mediafiles()->save($mediafile);
        }

        return $mediafile;

    } //  storePLU()

}
