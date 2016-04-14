<?php
namespace PsgSite;

class BaseController extends \Controller {

    protected $_jsMgr = null; // object
    protected $_cssMgr = null; // object
    protected $_php2jsVars = array();
    
    public function __construct()
    {
        $this->_cssMgr = new \Psg\CssManager();
        $this->_jsMgr = new \Psg\JsManager();

        // Check for active account
        // common to all site controllers
        $this->registerJsLibs([
         ]);

        $this->registerJsInlines([
         ]);

        $this->registerCssInlines([
         ]);

        //\View::share('g_user', \User::getUser());
        \View::share('g_php2jsVars',$this->_php2jsVars); // may be overridden in child
        \View::share('g_body_tag', 'default');
        
        return;
    }

	protected function setupLayout()
	{
		if ( !is_null($this->layout))
		{
			$this->layout = \View::make($this->layout);
		}
	}

    // Can be called multiple times
    public function registerJsLibs($libPaths=array())
    {
        foreach ($libPaths as $l) {
            $this->_jsMgr->pushLib($l);
        }
        \View::share('g_jsMgr',$this->_jsMgr);
    }
    public function registerJsInlines($inlinePaths=array())
    {
        foreach ($inlinePaths as $l) {
            $this->_jsMgr->pushInline($l);
        }
        \View::share('g_jsMgr',$this->_jsMgr);
    }

    public function registerCssInlines($inlinePaths=array())
    {
        foreach ($inlinePaths as $l) {
            $this->_cssMgr->pushInline($l);
        }
        \View::share('g_cssMgr',$this->_cssMgr);
    }

}
