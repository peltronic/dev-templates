<?php
namespace PsgAdmin;

class ExportTable {

    protected $_filepath = null;
    protected $_fp = null;
    protected $_table = null;
    protected $_records = [];
    protected $_exportableFields = [];

    public function __construct($filepath,$table,$exportableFields) {
        $this->_filepath = $filepath;
        $this->_table = $table;
        $this->_exportableFields = $exportableFields;
        $this->_savefile();
    } // __construct()

    public function download()
    {
        // Download
        header('Content-Description: File Transfer');
        header("Content-Type: text/plain");
        header('Content-Disposition: attachment; filename='.$this->_table.'-export.csv');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Content-Length: '.filesize($this->_filepath));
        //ob_clean();
        flush();
        //echo $strOut;
        readfile($this->_filepath);
        return;
    }

    // ====================

    protected function _savefile()
    {
        $numRecords = \DB::table($this->_table)->count();
if (0) {
        $limit = 1000;
} else { // DEBUG
        $limit = 10;
}
        $this->_openCsvFile();
        $writeHeader = 1;
        for ( $offset = 0 ; $offset < ($numRecords+$limit) ; $offset+=$limit ) {
            $this->_records = $this->_getRecords($offset,$limit);
            $this->_writeCsvFile($writeHeader);
            $writeHeader = 0;
/* DEBUG
if ($offset > 33) {
    break;
}
 */
        }
        $this->_closeCsvFile();

        //$r = parent::save($options);
        //return $r;
    }

    protected function _writeCsvFile($writeHeader=0)
    {
        $recordsOut = [];
        if ($writeHeader) {
            $recordsOut[0] = []; // header row
            foreach ($this->_exportableFields as $f) {
                $recordsOut[0][$f] = ucfirst($f);
            }
        }

        foreach ($this->_records as $i => $r) {
            if ( empty( $recordsOut[$r->id] ) ) {
                $pkid = $r->id;
                $recordsOut[$pkid] = [];
                foreach ($this->_exportableFields as $f) {
                    $recordsOut[$pkid][$f] = $r->{$f};
                }
            }
        }
        foreach ($recordsOut as $i => $f) {
            $this->fputcsv_eol($this->_fp, $f, "\r\n");
        }

    } // _writeCsvFile()

    // http://stackoverflow.com/questions/4080456/fputcsv-and-newline-codes
    // Writes an array to an open CSV file with a custom end of line.
    // $fp: a seekable file pointer. Most file pointers are seekable, 
    //   but some are not. example: fopen('php://output', 'w') is not seekable.
    // $eol: probably one of "\r\n", "\n", or for super old macs: "\r"
    function fputcsv_eol($fp, $array, $eol) {
        fputcsv($fp, $array);
        if("\n" != $eol && 0 === fseek($fp, -1, SEEK_CUR)) {
            fwrite($fp, $eol);
        }
    }

    protected function _getRecords($offset=0,$limit=1000)
    {
        // use offset & limit to generate videoIdMin and videoIdMax
        $initID = 1;
        $minID = $initID + intval($offset);
        $maxID = $minID + intval($limit);

        /*
        $records = \User::where('id','>=',$minID)
                        ->where('id','<',$maxID)
                        ->orderBy('id','ASC')
                        ->get();
         */
        $records = \DB::table($this->_table)
                        ->where('id','>=',$minID)
                        ->where('id','<',$maxID)
                        ->orderBy('id','ASC')
                        ->get();
        return $records;

    } // _getRecords

    protected function _openCsvFile()
    {
        $this->_fp = fopen($this->_filepath, 'w');
        if (empty($this->_fp)) {
            throw new \Exception('Could not open export file :'.$this->_filepath);
        }
    }

    protected function _closeCsvFile()
    {
        fclose($this->_fp);
    }


}
