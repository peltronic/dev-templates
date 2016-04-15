<?php
namespace App\Libs;

class Crudtable {
 
    protected $_table;
    protected $_route;
    protected $_sort = [];
    protected $_filters = [];

    protected $_attrs = []; // input query params
    protected $_availFilters = [];

    public function __construct($table,$availFilters=[])
    {
        $this->_table = $table;
        $this->_route = 'admin.'.$this->_table.'.index';
        $this->_sort['_sort_by'] = \Input::get('_sort_by','created_at');
        $this->_sort['_sort_dir'] = \Input::get('_sort_dir','asc');

        $this->_availFilters = $availFilters;

        $this->_attrs = \Input::all();
        unset($this->_attrs['page']);
        unset($this->_attrs['_sort_by']);
        unset($this->_attrs['_sort_dir']);

        /*
        foreach ($this->_attrs as $k => $v) {
            if ( ( empty($v) && ($v!==0) && ($v!=='0') ) ) {
                unset($this->_attrs[$k]);
            }
        }
        dd($this->_attrs);
         */

    } // __construct()

    public function makeQuery()
    {
        $q = \DB::table($this->_table)->orderBy($this->_sort['_sort_by'],$this->_sort['_sort_dir']);
        return $q;
    }

    // NOTE: modifies the query
    public function applyFilters(&$query)
    {
        foreach ($this->_availFilters as $f) {

            if ( array_key_exists($f,$this->_attrs) && !empty($this->_attrs[$f]) ) {

                $this->_filters[$f] = $this->_attrs[$f]; // add to filters applied

                // Do the filte
                switch ($f) {
                    default:
                        $query->where($f,'LIKE','%'.$this->_attrs[$f].'%');
                }
            }
        }
    } // applyFilters()

    public function url($ignoreFilters=0)
    {
        $params = $ignoreFilters ? $this->_sort : array_merge($this->_filters,$this->_sort);
        $url = route($this->_route,$params);
        return $url;
    }

    public function headerparams()
    {
        $flat = array_merge($this->_filters,$this->_sort);
        return $flat;
    } // headerparams()

    public function headerlink($name, $column)
    {
        $html = link_to_route(
            //$route, // 'admin.subscribers.index'
            $this->_route, // 'admin.subscribers.index'
            $name, //'ID'
            array_merge(
                        $this->_filters,
                        [
                            '_sort_by'=>$column,
                            '_sort_dir'=>($this->_sort['_sort_dir']=='asc') ? 'desc' : 'asc'
                        ]
            )
        );
        return $html;
    } // headerlink()

    public function renderFilterForm()
    {
        $html = \View::make('admin._listfilterform',[
            //'route'=>'admin.'.$this->_table.'.index',
            'route'=>$this->_route,
            'avail_filters'=>$this->_availFilters,
            'clear_url'=>$this->url(1),
        ])->render();
        return $html;
    }

}
