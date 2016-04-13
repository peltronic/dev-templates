<?php
namespace PsgApi;

class RewardsController extends BaseController {

    public function __construct()
    {
        if (!\Request::ajax()) {
            throw new \Exception('Requires AJAX');
        }

        parent::__construct();
    }

    // %NOTE: for now, just going to download the list in the page itself via g_php2jsVars
    public function index()
    {
        $filter = \Input::get('filter','available');

        $ugroupSlug = \Input::get('ugroup_slug');
        $univUgroup = \Ugroup::where('slug','=',$ugroupSlug)->firstOrFail();
        $user = \Auth::user(); // session user
        switch ($filter) {
            case 'redeemed':
                $rewards = \Reward::getRedeemedByUser($user);
                break;
            case 'claimed':
                $rewards = \Reward::getClaimedByUser($user);
                break;
            case 'available':
            default:
                $rewards = \Reward::getEligibleByUgroup($univUgroup,$user);
        }

        $bizprofiles = [];
        foreach ($rewards as $r) {
            $bf = $r->user->business_profile;
            unset($bf->geocode_json);
            if ( empty($bizprofiles[$bf->slug]) ) {
                $bizprofiles[$bf->slug] = ['profile'=>$bf,'rewards'=>[$r],'infohtml'=>null];
            } else {
                $bizprofiles[$bf->slug]['rewards'][] = $r;
            }
        }
        $index = 0;
        foreach ( $bizprofiles as $bpslug => $obj ) {
            $bf = $obj['profile'];
            $bizprofiles[$bf->slug]['index'] = $index++;
            $bizprofiles[$bf->slug]['infohtml'] = '<ul class="crate-map_reward_list_for_business">';
            $bizprofiles[$bf->slug]['infohtml'] = '<h6>Offers by '.link_to($bf->url,$bf->business_name).'</h6>';
            foreach ( $bizprofiles[$bf->slug]['rewards'] as $r ) {
                if ( $r->isAvailableToUser($user) ) {
                    $bizprofiles[$bf->slug]['infohtml'] .= '<li>';
                    $bizprofiles[$bf->slug]['infohtml'] .= link_to_route('rewards.show',$r->name,$r->id,['class'=>'tag-clickme_to_claim_reward']);
                    $bizprofiles[$bf->slug]['infohtml'] .= ' - ends in '.\Psg\ViewHelpers::getTimeUntil($r->enddate);
                    $bizprofiles[$bf->slug]['infohtml'] .= '</li>';
                }
            }
            $bizprofiles[$bf->slug]['infohtml'] .= '</ul>';
        }
//$bf->infoHtml = '<ul><li>test1</li></ul>';

        // Get list of rewards
        // Create list of businesses (that are represented in the rewards list)
        // Create list of businesses (that are present in the rewards list)
        $html =  \View::make('site::rewards._list',['rewards'=>$rewards,'bizprofiles'=>$bizprofiles,'user'=>$user])->render();
        $response = ['is_ok'=>1,'rewards'=>$rewards,'bizprofiles'=>$bizprofiles,'html'=>$html];

        return \Response::json($response);
    }

}

