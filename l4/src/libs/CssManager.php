<?php
namespace App\Libs;

class CssManager {

    protected $_inlinePaths;

    public function __construct($inlinePaths=array())
    {
        // NOTE: these are arrays, default to empty arrays
        $this->_inlinePaths = $inlinePaths;
    }


    public function pushInline($file)
    {
        if ( (substr($file,0,1)!="/") && !strstr($file,"//") ) {
            $file = "/".$file;
        }
        $this->_inlinePaths[] = $file;
    }


    public function renderInlines()
    {
		$html = '';
		foreach ($this->_inlinePaths as $file) {
			$isLocal = (strstr($file,'//') ? 0 : 1);
            if ($isLocal and !file_exists(public_path().$file)) {
                continue; // local and not updated (? PSG)
            }
			$time = ($isLocal ? filemtime(public_path().$file) : NULL);
			$html .= '<link media="all" type="text/css" rel="stylesheet" href="'.$file.($time ? "?".$time : "").'">'."\n";
            
		}
		
        return $html;
    } // render()
    
    public function minify($c = NULL) {                    
        // tbd
	}
}
