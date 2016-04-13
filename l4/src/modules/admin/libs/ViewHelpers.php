<?php
namespace PsgAdmin;

class ViewHelpers {

    public static function renderSidebarMenu($routes) 
    {
        $currentRouteName = \Route::currentRouteName();
        $html = '';
        $html .= '<ul class="crate-sidebar tag-ctrls stacked button-group">';
        foreach ($routes as $key => $obj) {
            $rname = $obj['route'];
            $classes = ['button','tiny','radius'];
            if ($currentRouteName != $rname) {
                $classes[] = 'tag-not_active'; // else active
            } else {
                $classes[] = 'tag-active';
            }
            $classStr = implode(' ',$classes);
            if ( !empty($obj['params']) ) {
                $html .= '<li>'.link_to_route($rname,$obj['title'],$obj['params'],['class'=>$classStr]).'</li>';
            } else {
                $html .= '<li>'.link_to_route($rname,$obj['title'],[],['class'=>$classStr]).'</li>';
            }
        }
        $html .= '</ul>';
        return $html;
    }

}
