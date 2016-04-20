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
        $attrs = \Input::all();

        // %FIXME: do validation

        if ( \Input::hasFile('mediafile') ) {
            $siteconfig = empty($belongsToPKID) ? null: \App\Models\Siteconfig::find($belongsToPKID);
            \App\Models\Mediafile::savePLU($attrs,$siteconfig);
        }

    } //  storePLU()

    public function store()
    {
        if (!\Request::ajax()) {
            throw new \Exception('Requires AJAX');
        }

        $user = \Auth::user();

        $attrs = \Input::all();
        $attrs['is_orig_content'] = (\Input::get('is_orig_content')==='yes') ? 1 : 0; // checkbox
        $meta = [];

        $msgType = $attrs['msg_type'];
        unset($attrs['msg_type']);

        $rules = \Message::getValidationRules($msgType);

        try {
            $uGroup = \Ugroup::findOrFail($attrs['ugroup_id']);

            // University groups are open to all, course groups are restricted
            if (!$uGroup->isUniversityGroup()) {
                if ( !self::isUserInUgroup($uGroup) && !$user->hasRole('admin') ) {
                    \App::abort(403, 'Unauthorized action');
                }
            }

            $attrs['user_id'] = $user->id;
            $attrs['ugroup_id'] = $uGroup->id;
            if ( empty($attrs['parent_id']) ) {
                unset($attrs['parent_id']); // unset when 0
                // root/base message...requires title
                $rules['title'] = 'required|min:1|max:255';
            } else {
                // reply message
                $rules['parent_id'] = 'required|integer';
            }
            if ( array_key_exists('calevent_date',$_POST) ) {
                $rules['period'] = 'required';
                $rules['calevent_date'] = 'required';
                $rules['hour'] = 'required|integer|min:0|max:24';
                $rules['minute'] = 'required|integer|min:0|max:59';
            }

            // %FIXME: do validation
            $validator = \Validator::make($attrs, $rules);

            if ($validator->fails()) {
                throw new \Exception('Validation failed', CLEX_VALIDATION);
            }

            $attrs['mtype'] = 'text'; // default

            if ( \Input::hasFile('mediafile') ) {
                $attrs['mtype'] = 'image';
                $guid       = \Cl\Guid::create();
                $ogfilename = \Input::file('mediafile')->getClientOriginalName();
                $ext        = pathinfo($ogfilename, PATHINFO_EXTENSION);
                $caption    = \Input::get('caption',null); // caption belongs to mediafile
                unset($attrs['caption']);
                $attrs['content'] = $caption;
    
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mimetype = finfo_file($finfo, \Request::file('mediafile'));
                finfo_close($finfo);

                $newFilename = $guid.'.'.$ext;
                \Input::file('mediafile')->move(PATH_CDN_MEDIA.'/', $newFilename);
                if ( ($ext!='gif') && \Cl\Mime::isImage($mimetype) ) {
                    $resizedFilename = \Cl\MediafileManager::resizeToMid(PATH_CDN_MEDIA.'/'.$newFilename,$guid);
                    $resizedFilename = \Cl\MediafileManager::resizeToThumb(PATH_CDN_MEDIA.'/'.$newFilename,$guid);
                }

                $fattrs = compact('guid','ogfilename','ext','mimetype','caption');
            } else {
                $fattrs = null;
            }

            // Message type: link
            if ( !empty($attrs['url']) ) {
                $emb = new \Cl\EmbedlyManager;
                $meta['embedly'] = $emb->oembed($attrs['url']);
                $attrs['mtype'] = 'link';
            }

            // Message type: Calevent
            if ( !empty($attrs['calevent_date']) ) {
                $meta['calevent'] = ['date'=>$attrs['calevent_date']];
                $attrs['mtype'] = 'calevent';
                // reverse the date format
                list($monthnum,$datenum,$year) =  explode('-',$attrs['calevent_date']);
                $attrs['eventdate'] = $year.'-'.$monthnum.'-'.$datenum;
            } else {
                unset($attrs['eventdate']);
            }

            $attrs['meta'] = json_encode($meta);

            // Deal with slug: from title for root messages, else just use pkid
            if ( empty($attrs['parent_id']) ) {
                $attrs['slug'] = \Cl\MessageManager::strToSlug($attrs['title']);
            }

            list($obj,$mediafile) = \DB::transaction(function() use($user,$attrs,$fattrs) {
                $obj = \Message::create($attrs);
                if ( !empty($attrs['parent_id']) ) {
                    // ?? %FIXME: this makes no sense 20151027
                    $obj->slug = $obj->id;
                    $obj->save();
                    \Cl\NotificationManager::createReply($obj);
                }
                if ( !empty($fattrs) ) {
                    $fattrs['message_id'] = $obj->id;
                    $mediafile = \Mediafile::create($fattrs);
                } else {
                    $mediafile = null;
                }
                if ( !empty($attrs['calevent_date']) ) {
                    list($monthnum,$datenum,$year) =  explode('-',$attrs['calevent_date']);
                    // convert to 24-hour format
                    $hour = $attrs['hour'];
                    $hour = ($attrs['period']=='am') ? $hour : ($hour+12); 

                    $calevent = \Calevent::create([
                                    'extlink'=>$attrs['extlink'],
                                    'is_direct_link'=>empty($attrs['is_direct_link']) ? 0 : 1,
                                    'datenum'=>$datenum,
                                    'monthnum'=>$monthnum,
                                    'year'=>$year,
                                    'hour'=>$hour,
                                    'minute'=>$attrs['minute'],
                                    'location'=>$attrs['location'],
                                    'message_id'=>$obj->id,
                                ]);
                }
                if ( empty($attrs['parent_id']) ) {
                    switch ($obj->getMessageType()) {
                        case 'calevent':
                            $ptslug = $obj->is_orig_content ? 'create-post-with-event' : 'create-post-with-event-not_oc' ;
                            break;
                        case 'image':
                            $ptslug = $obj->is_orig_content ? 'create-post-with-photo' : 'create-post-with-photo-not_oc' ;
                            break;
                        case 'poll':
                            $ptslug = $obj->is_orig_content ? 'create-post-with-poll' : 'create-post-with-poll-not_oc' ;
                            break;
                        case 'link':
                            $ptslug = $obj->is_orig_content ? 'create-post-with-link' : 'create-post-with-link-not_oc' ;
                            break;
                        case 'text':
                            $ptslug = $obj->is_orig_content ? 'create-post-text' : 'create-post-text-not_oc' ;
                            break;
                        default:
                            throw new \Exception('Unknown message type: '.$obj->getMessageType());
                    } // switch()
                    \Cl\PointManager::recordPointsByUser($user->id,$ptslug);
                } else {
                    $parentMessage = \Message::findOrFail($attrs['parent_id']);
                    if ($parentMessage->is_orig_content) {
                        \Cl\PointManager::recordPointsByUser($user->id,'comment-on-post');
                        \Cl\PointManager::recordPointsByUser($parentMessage->user_id,'commented-on-my-post');
                    } else {
                        \Cl\PointManager::recordPointsByUser($user->id,'comment-on-post-not_oc');
                        \Cl\PointManager::recordPointsByUser($parentMessage->user_id,'commented-on-my-post-not_oc');
                    }
                }
                return [$obj,$mediafile];
            });

            $response = ['is_ok'=>1, 'obj'=>$obj, 'mtype'=>$attrs['mtype']];

        } catch (\Exception $e) {
//throw $e;
            // validation not successful, send back to form 
            $ecode = $e->getCode();
            switch ($ecode) {
                case CLEX_VALIDATION:
                    $messages = $validator->messages();
                    $metaErrors = [];
                    break;
                default:
                    if ( !empty($guid) ) {
                        \Cl\MediafileManager::destroyByGuid($guid); // transaction failed, clean-up
                    }
                    $messages = [];
                    $metaErrors = [$e->getMessage()];
            }
            $response = [ 'is_ok'=>0, 'messages'=>$messages, 'meta_errors'=>$metaErrors ];
        }


        return \Response::json($response);

    } // store()
}
