<?php
namespace App\Http\Controllers\Site;

use App\Http\Controllers\SiteController;

class SiteconfigsController extends SiteController {

    public function __construct()
    {
        parent::__construct();

        /*
        // must be after parent call!
        $this->registerJsLibs([
         ]);
        $this->registerJsInlines([
         ]);
         */
    }

    public function show()
    {
        $data = [];
        /*
        $user = empty($username) ? \Auth::user() : \User::where('username',$username)->firstOrFail();

        $data['user'] = $user;
        $data['is_account_owner'] = $this->isAccountOwner($user->id);

        $data['my_stories'] = $my_stories = \Story::getMy($user);
        $data['my_chapters'] = $my_chapters = \Chapterversion::getMy($user);
         */

        return \View::make('site.siteconfigs.index',$data);
    }

    public function index()
    {
        $data = [];
        /*
        $user = empty($username) ? \Auth::user() : \User::where('username',$username)->firstOrFail();

        $data['user'] = $user;
        $data['is_account_owner'] = $this->isAccountOwner($user->id);

        $data['my_stories'] = $my_stories = \Story::getMy($user);
        $data['my_chapters'] = $my_chapters = \Chapterversion::getMy($user);
         */

        return \View::make('site.siteconfigs.index',$data);
    }
}
