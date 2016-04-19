<?php
namespace App\Libs;

class ViewHelpers {

    public static function makeNiceDate($dateIn)
    {
        $dateOut = date("F d, Y G:i", strtotime($dateIn));
        return $dateOut;
    }

    public static function linkToRouteWithHtml($route,$html,$params=[],$attrs=[])
    {
        $html = html_entity_decode( 
                                    link_to_route( 
                                        $route,
                                        $html,
                                        $params,
                                        $attrs
                                    ) 
                                  );
        return $html;
    }

    public static function linkToWithHtml($url,$html,$attrs=[])
    {
        $html = html_entity_decode( 
                                    link_to( 
                                        $url,
                                        $html,
                                        $attrs
                                    ) 
                                  );
        return $html;
    }

    public static function linkToRouteWithImg($route,$imgPath,$imgAlt,$imgAttrs=[],$linkClasses=[])
    {
        $html = html_entity_decode( 
                                    link_to_route( 
                                        $route,
                                        \HTML::image(
                                            $imgPath,
                                            $imgAlt,
                                            $imgAttrs //array('class'=>'tag-usericon'), array( 'width' => 70, 'height' => 70 )
                                        ) 
                                    ) 
                                  );
        return $html;
    }

    public static function linkToWithImg($url,$imgPath,$imgAlt,$imgClasses=[],$linkClasses=[])
    {
        $html = html_entity_decode( 
                                    link_to( 
                                        $url,
                                        \HTML::image(
                                            $imgPath,
                                            $imgAlt,
                                            $imgClasses //array('class'=>'tag-usericon')
                                        ), 
                                        $linkClasses
                                    ) 
                                  );
        return $html;
    }
}
