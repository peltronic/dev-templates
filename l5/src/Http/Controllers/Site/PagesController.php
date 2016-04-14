<?php
namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

class PagesController extends Controller {

    public function __construct()
    {
        parent::__construct();

        // must be after parent call!
        $this->registerJsLibs([
         ]);
        $this->registerJsInlines([
         ]);
    }


    public function show($slug)
    {
        $data = [];
        switch ($slug) {
            case 'home':
                return redirect('/');
                break;
            default:
                //\App::abort(404);
                $viewFile = 'site.pages.'.$slug;
        }

        try {
            return \View::make($viewFile, $data);
        } catch (\Exception $e) {
            \App::abort(404);
        }

    } // show()

}
