<?php
namespace App\Libs;

class MediafileManager {

    // Delete a mediafile and all its resources
    //   ~ used when updating a draft (new image, or additional audio, etc)
    //   ~ be sure to get midsize/thumbnails if any
    public static function destroyByGuid($guid,$table='mediafiles')
    {
        $mediafile = \DB::table($table)->where('guid', $guid)->first();
        
        // %NOTE: require transaction at caller level

        $isOK = 1;

        if ( empty($mediafile) ) {
            return $isOK;
        }

        // Do the delete
        \DB::table($table)->where('guid','=',$mediafile->guid)->delete();

        // Cleanup resources
        $filepath = self::getMediaPath($mediafile,$mediafile->ext);
        if ( file_exists($filepath) ) {
            $isOK = unlink($filepath);    
            if (!$isOK) {
                throw new Exception('Could not unlink file: '.$filepath);
            }
        }

        $filepath = self::getImgMidPath($mediafile);
        if ( file_exists($filepath) ) {
            $isOK = unlink($filepath);    
            if (!$isOK) {
                throw new Exception('Could not unlink file: '.$filepath);
            }
        }

        $filepath = self::getImgThumbPath($mediafile);
        if ( file_exists($filepath) ) {
            $isOK = unlink($filepath);    
            if (!$isOK) {
                throw new Exception('Could not unlink file: '.$filepath);
            }
        }

        return $isOK;
    }

    public static function renderMid($mediafile) 
    {

        $thumbimgUrl = self::getImgThumbUrl($mediafile);
        $imgUrl = self::getMediaUrl($mediafile);
        //dd($imgUrl);

        $imgAttrs = ['width'=>250]; //%FIXME 'title'=>$mediafile->caption]; //,'data-tooltip','aria-haspopup'=>'true','class'=>'has-tip','title'=>$mediafile->caption];
        $linkAttrs = ['target'=>'_blank','title'=>$mediafile->caption];
        $html = '';
        if ( !empty($imgUrl) ) {
            $html .= \Cl\ViewHelpers::linkToWithImg($imgUrl,$thumbimgUrl,'TBD',$imgAttrs,$linkAttrs);
        }
        if ( !empty($mediafile->caption) ) {
            $html .= '<div class="tag-caption">'.htmlentities($mediafile->caption).'</div>';
        }
        return $html;
    }

    public static function renderThumbnail($mediafile) 
    {

        $thumbimgUrl = self::getImgThumbUrl($mediafile);
        $imgUrl = self::getMediaUrl($mediafile);
        //dd($imgUrl);

        $imgAttrs = ['width'=>50]; //,'title'=>$mediafile->caption]; //,'data-tooltip','aria-haspopup'=>'true','class'=>'has-tip','title'=>$mediafile->caption];
        $linkAttrs = ['target'=>'_blank','title'=>$mediafile->caption];
        $html = '';
        if ( !empty($imgUrl) ) {
            $html .= \Cl\ViewHelpers::linkToWithImg($imgUrl,$thumbimgUrl,'TBD',$imgAttrs,$linkAttrs);
        }
        return $html;
    }

    public static function getMediaUrl($mediafile)
    {
        $url = URL_CDN_MEDIA.'/'.$mediafile->guid.'.'.$mediafile->ext;
        return $url;
    }
    public static function getImgMidUrl($mediafile)
    {
        $ext = 'jpg'; // always jpeg here
        $url = URL_CDN_IMG_MID.'/'.$mediafile->guid.'.'.$ext;
        return $url;
    }
    public static function getImgThumbUrl($mediafile)
    {
        $ext = 'jpg'; // always jpeg here
        $url = URL_CDN_IMG_THUMB.'/'.$mediafile->guid.'.'.$ext;
        return $url;
    }

    public static function getMediaPath($mediafile,$ext=null)
    {
        $path = PATH_CDN_MEDIA.'/'.$mediafile->guid.'.'.$mediafile->ext;
        return $path;
    }
    public static function getImgMidPath($mediafile)
    {
        $ext = 'jpg'; // always jpeg here
        $path = PATH_CDN_IMG_MID.'/'.$mediafile->guid.'.'.$ext;
        return $path;
    }
    public static function getImgThumbPath($mediafile)
    {
        $ext = 'jpg'; // always jpeg here
        $path = PATH_CDN_IMG_THUMB.'/'.$mediafile->guid.'.'.$ext;
        return $path;
    }

    public static function resizeToMid($imgPathIn,$guid)
    {

        //$imgFile ='http://cdn.dev-bb.com/media/5063625b-0b45-c5b0-721c-55492be0d95c.jpg'; 
        $w = 525;
        $h = 0;
        $outputPath = PATH_CDN_IMG_MID;
        $filename = \Cl\Image::resize($imgPathIn, $w, $h, $guid, $outputPath,1); // force jpeg
        return $filename;
    }

    public static function resizeToThumb($imgPathIn,$guid)
    {

        //$imgFile ='http://cdn.dev-bb.com/media/5063625b-0b45-c5b0-721c-55492be0d95c.jpg'; 
        $w = 256;
        $h = 0;
        $outputPath = PATH_CDN_IMG_THUMB;
        $filename = \Cl\Image::resize($imgPathIn, $w, $h, $guid, $outputPath,1); // force jpeg
        return $filename;
    }

}
