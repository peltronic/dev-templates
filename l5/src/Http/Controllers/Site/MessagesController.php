<?php
namespace App\Http\Controllers\Site;

use App\Http\Controllers\SiteController;

class MessagesController extends SiteController {

    public function __construct()
    {
        parent::__construct();

        $this->registerJsLibs([
            //'//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js',
            '/js/vendor/plupload/plupload.full.min.js',
            'js/vendor/plupload/jquery.ui.plupload.js',
            'js/app/common/libs/psgFormUtils.js',
        ]);
        $this->registerJsInlines(['/js/app/site/inline/initPlupload.js']);

        $this->registerCssInlines([ 
            //'//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/themes/smoothness/jquery-ui.min.css',
            //'//www.plupload.com/plupload/js/jquery.ui.plupload/css/jquery.ui.plupload.css',
        ]);
    }

    public function show($pkid)
    {
        $data = [];
        $message = $data['message'] = \App\Models\Message::findOrFail($pkid);
        return \View::make('site.messages.index',$data);
    }

    public function index()
    {
        $data = [];
        $messages = $data['messages'] = \App\Models\Message::get();
        return \View::make('site.messages.index',$data);
    }

    public function create()
    {
        $data = [];

        $submitURL = $data['submitURL'] = route('messages.store');
        $storePluURL = $data['storePluURL'] = route('messages.storePLU');
        $data['classes'] = ['form-horizontal'];

        return \View::make('site.messages.create',$data);
    }

    public function storePLU($belongsToPKID=null)
    {
        if (!\Request::ajax()) {
            throw new \Exception('Requires AJAX');
        }

        $attrs = \Input::all();

        if ( !\Input::hasFile('mediafile') ) {
            $response = ['is_ok'=>0,'obj'=>null];
        }

        // %FIXME: do validation

        try {
            $message = empty($belongsToPKID) ? null: \App\Models\Message::find($belongsToPKID);
            $mediafile = \App\Models\Mediafile::savePLU($attrs,$message);
        
            // Move the mediafile file & create thumbnails
            // %TODO: good candidate for an event?
            $newFilename = $mediafile->guid.'.'.$mediafile->ext;
            \Input::file('mediafile')->move(PATH_CDN_MEDIA.'/', $newFilename);
            if ( ($mediafile->ext!='gif') && \App\Libs\Mime::isImage($mimetype) ) {
                $resizedFilename = \App\Libs\MediafileManager::resizeToMid(PATH_CDN_MEDIA.'/'.$newFilename,$mediafile->guid);
                $resizedFilename = \App\Libs\MediafileManager::resizeToThumb(PATH_CDN_MEDIA.'/'.$newFilename,$mediafile->guid);
            }

            $response = ['is_ok'=>1,'obj'=>$mediafile];

            // %TODO %FIXME: if this fails we should clean-up/delete the message?

        } catch (\Exception $e) {
throw $e;
            // validation not successful, send back to form 
            $ecode = $e->getCode();
            switch ($ecode) {
                case EX_VALIDATION:
                    $messages = $validator->messages();
                    $metaErrors = [];
                    break;
                default:
                    if ( !empty($guid) ) {
                        //%FIXME: \Cl\MediafileManager::destroyByGuid($guid); // transaction failed, clean-up
                    }
                    $messages = [];
                    $metaErrors = [$e->getMessage()];
            }
            $response = [ 'is_ok'=>0, 'messages'=>$messages, 'meta_errors'=>$metaErrors ];
        }

        return \Response::json($response);

    } //  storePLU()

    public function store()
    {
        if (!\Request::ajax()) {
            throw new \Exception('Requires AJAX');
        }

        $user = \Auth::user();

        $attrs = \Input::all();
        $attrs['user_id'] = $user->id;

        $rules = \App\Models\Message::getValidationRules();
        $rules['title'] = 'required|min:1|max:255';
        unset($rules['slug']); // set below, post-validation

        try {

            $validator = \Validator::make($attrs, $rules);

            if ($validator->fails()) {
                throw new \Exception('Validation failed', EX_VALIDATION);
            }

            $attrs['slug'] = \App\Libs\Utils::slugify($attrs['title'],'messages');

            $obj = \App\Models\Message::create($attrs);

            $response = ['is_ok'=>1,'obj'=>$obj];

        } catch (\Exception $e) {
//throw $e;
            // validation not successful, send back to form 
            $ecode = $e->getCode();
            switch ($ecode) {
                case EX_VALIDATION:
                    $messages = $validator->messages();
                    $metaErrors = [];
                    break;
                default:
                    if ( !empty($guid) ) {
                        //%FIXME: \Cl\MediafileManager::destroyByGuid($guid); // transaction failed, clean-up
                    }
                    $messages = [];
                    $metaErrors = [$e->getMessage()];
            }
            $response = [ 'is_ok'=>0, 'messages'=>$messages, 'meta_errors'=>$metaErrors ];
        }

        return \Response::json($response);

    } // store()
}
