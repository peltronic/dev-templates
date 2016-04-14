<?php
namespace App\Libs;

class JsManager {
    protected $_libPaths;
    protected $_inlinePaths;

    public function __construct($inlinePaths=array(),$libPaths=array())
    {
        // NOTE: these are arrays, default to empty arrays
        $this->_libPaths = $libPaths;
        $this->_inlinePaths = $inlinePaths;
    }

    public function pushLib($file)
    {
        if ( (substr($file,0,1)!="/") && !strstr($file,"//") ) {
            $file = "/".$file;
        }
        $this->_libPaths[] = $file;
    }

    public function pushInline($file)
    {
        if ( (substr($file,0,1)!="/") && !strstr($file,"//") ) {
            $file = "/".$file;
        }
        $this->_inlinePaths[] = $file;
    }

    public function renderLibs()
    {
		$html = '';
		foreach ($this->_libPaths as $file) {
			$isLocal = (strstr($file,'//') ? 0 : 1);
            if ($isLocal and !file_exists(public_path().$file)) {
                continue; // local and not updated (? PSG) (or doesn't actually exist)
            }
// %FIXME
            if ( 1 || defined('IS_THROTTLING_DISABLED') && IS_THROTTLING_DISABLED ) {
			    $html .= '<script type="application/javascript" src="'.$file.'"></script>'."\n";
            } else {
			    $time = ($isLocal ? filemtime(public_path().$file) : NULL);
			    $html .= '<script type="application/javascript" src="'.$file.($time ? "?".$time : "").'"></script>'."\n";
            }
		}
		
        return $html;
    } // render()

    public function renderInlines()
    {
//dd('here wtf 2');
		$html = '';
		foreach ($this->_inlinePaths as $file) {
			$isLocal = (strstr($file,'//') ? 0 : 1);
            if ($isLocal and !file_exists(public_path().$file)) {
                continue; // local and not updated (? PSG) (or doesn't actually exist : %FIXME -- throw exception?)
            }
// %FIXME
            if ( 1 || defined('IS_THROTTLING_DISABLED') && IS_THROTTLING_DISABLED ) {
			    $html .= '<script type="application/javascript" src="'.$file.'"></script>'."\n";
            } else {
			    $time = ($isLocal ? filemtime(public_path().$file) : NULL);
			    $html .= '<script type="application/javascript" src="'.$file.($time ? "?".$time : "").'"></script>'."\n";
            }
		}
		
        return $html;
    } // render()
    
    public function minify($c = NULL) {                    
        // tbd
	}
}
