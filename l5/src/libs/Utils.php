<?php
namespace App\Libs;

class Utils {

    // if student, goes to university board
    public static function getDashboardURL($user=null)
    {
        $user = empty($user) ? \Auth::user() : $user;
        if ($user->hasRole('business')) {
            $redirectURL = route('business.dashboard.index');
        } else if ($user->hasRole('student')) {
            $univUGroup = $user->getUniversityUgroup();
            $redirectURL = route('site.boards.show',$univUGroup->slug);
        } else {
            $redirectURL = route('site.contact');
        }
        return $redirectURL;
    }
    public static function redirectToDashboard($user=null)
    {
        $user = empty($user) ? \Auth::user() : $user;
        $redirectURL = self::getDashboardURL($user);
        return \Redirect::to($redirectURL);
    }

    public static function getHourSelectOptions($is24Period=1)
    {
        $options = [];
        if ($is24Period) {
            for ($i = 0 ; $i <= 23 ; $i++ ) {
                $options[$i] = sprintf('%02d', $i);
            }
        } else {
            // am/pm periods
            foreach ( [12,1,2,3,4,5,6,7,9,10,11] as $h) {
                $options[$h] = sprintf('%02d', $h);
            }
        }
        return $options;
    }
    public static function getMinuteSelectOptions()
    {
        $options = [];
        for ($i = 0 ; $i <= 59 ; $i++ ) {
            $options[$i] = sprintf('%02d', $i);
        }
        return $options;
    }

    public static function _formval($obj,$field)
    {
        if (empty($obj)) {
            return null;
        }
        /*
        if (empty($obj->{$field})) {
            throw new \Exception('field not found: '.$field);
            return null;
        }
         */
        $val = $obj->{$field};
        return empty($val) ? null : $val;
    }

    public static function currentMonthNum()
    {
        return date('m');
    }
    public static function currentYear()
    {
        return date('Y');
    }

    public static function fillUrlFromDomain($domain)
    {
        $url = 'http://www.'.$domain;
        return $url;
    }
    public static function parseDomainFromURL($url)
    {
        $urlParts = parse_url($url);
        $domain = preg_replace('/^www\./', '', $urlParts['host']); // remove www
        return $domain;
    }

    public static function getLaravelEnv()
    {
        $laravelEnv = null;

        if        ( !empty($_SERVER['SERVER_ADDR']) && ($_SERVER['SERVER_ADDR']=='127.0.0.1') ) {
            $laravelEnv = 'local';
        } else if ( !empty($_SERVER['HTTP_HOST']) && ($_SERVER['HTTP_HOST']=='www.dev-clssfy.com') )  {
            $laravelEnv = 'local';
        } else if (
            !empty($_SERVER['HTTP_HOST']) &&
            ( ($_SERVER['HTTP_HOST']=='www.clssfy.com') || ($_SERVER['HTTP_HOST']=='staging.clssfy.com')  )
        )
        {
            $laravelEnv = 'production';
        }
        return $laravelEnv;
    }


    // like link_to_route, but specific to dashboard and distinguishes client vs agent
    public static function linkToDashboard($user,$title=null,$classes=[])
    {
        if ( $user->hasRole('client') ) {
            return link_to_route('site.client.dashboard',$title,$user->id, ['class'=>implode(' ',$classes)]);
        } else if ( $user->hasRole('bondagent') ) {
            return link_to_route('site.bondsman.dashboard',$title,$user->id, ['class'=>implode(' ',$classes)]);
        } else {
            return link_to_route('site.home');
        }
    }

    public static function mixpanelIgnore()
    {
        $ignore = 0;
        if  (\Auth::guest()) {
            return $ignore; // this will not ignore them
        }
        $serverName = \Request::server ("SERVER_NAME");
        switch ($serverName) {
            case 'www.dev-clssfy.com':
            case 'staging.clssfy.com':
                $ignore = 1;
                break;
        }

        $user = \Auth::user();
        switch ($user->email) {
            case 'peter@peltronic.com':
            case 'peter@ucla.edu':
            case 'kevin1@ucsd.edu':
            case 'kky005@ucsd.edu':
            case 'thunderkate@ucsd.edu':
            case 'admin@ucsd.edu':
                $ignore = 1;
                break;
        }
        return $ignore;
    }

    public static function getJSRoutes()
    {
        $routes = [];
        $routeCollection = \Route::getRoutes();
        foreach ($routeCollection as $value) {
            $methods = $value->methods();
            foreach ($methods as $m) {
                if ($m != 'HEAD') {
                    $routes[$m.'.'.$value->getName()] = '/'.$value->getUri();
                }
            }
        }
        return $routes;
    }

    static public function slugify($strIN,$table=null)
    {
        $slug = preg_replace('~[^\\pL\d]+~u', '-', $strIN); // replace non letter or digits by -
        $slug = trim($slug, '-'); // trim
        //$slug = iconv('utf-8', 'us-ascii//TRANSLIT', $slug); // transliterate
        $slug = strtolower($slug); // lowercase
        $slug = preg_replace('~[^-\w]+~', '', $slug); // remove unwanted characters

        if ( empty($table) ) {
            return $slug;
        }

        // ensure unique
        $iter = 1;
        $ogSlug = $slug;
        do {
            $numMatches = \DB::table($table)->where('slug','=',$slug)->count();
            if ( ($numMatches==0) || ($iter>10) ) {
                break; // already unique, or we've exceeded max tries
            }
            $slug = $ogSlug.'-'.rand(1,999);
        } while ( $numMatches>0 );

        return $slug;
    }  // slugify()

    static public function getBgImgByUniv($univSlug)
    {
        $univ = \University::where('slug',$univSlug)->first();
        if ( empty($univ) ) {
            return null;
        }

        $files = [];
        $dirpath = public_path().'/img/background-boards/'.$univSlug;
        if ( $handle = opendir($dirpath) ) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    $files[] = $entry;
                }
            }
            closedir($handle);
        }
        //dd($files);

        // pick one at random
        $max = count($files) - 1;
        $index = mt_rand(0,$max);
        //dd($index);
        $bgfile = $files[$index];

//dd($bgfile);
        return $bgfile;
        /*
        $univ = \University::where('slug',$univSlug)->first();
        if ( empty($univ) ) {
            return null;
        }

        $bgimgs = \Backgroundimage::where('university_id',$univ->id)->get();
        if ( !count($bgimgs) ) {
            return null;
        }

        // pick one at random
        $max = count($bgimgs) - 1;
        $index = mt_rand(0,$max);
        //dd($index);
        $bgimg = $bgimgs[$index];
        $bgimg->index = $index;

        return $bgimg;
         */
    }

}
