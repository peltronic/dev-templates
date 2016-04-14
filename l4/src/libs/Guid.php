<?php
namespace PsgApp;

class Guid {

    public static function create() {
        $microTime = microtime();
        list($a_dec, $a_sec) = explode(" ", $microTime);

        $dec_hex = dechex($a_dec* 1000000);
        $sec_hex = dechex($a_sec);

        self::checkLength($dec_hex, 5);
        self::checkLength($sec_hex, 6);

        $guid = '';
        $guid .= $dec_hex;
        $guid .= self::createSegment(3);
        $guid .= '-';
        $guid .= self::createSegment(4);
        $guid .= '-';
        $guid .= self::createSegment(4);
        $guid .= '-';
        $guid .= self::createSegment(4);
        $guid .= '-';
        $guid .= $sec_hex;
        $guid .= self::createSegment(6);

        return $guid;
    }

    protected static function createSegment($chars) {
        $str = '';
        for($i=0; $i<$chars; $i++) {
            $str .= dechex(mt_rand(0,15));
        }
        return $str;
    }

    protected static function checkLength(&$str, $length) {
        $strlen = strlen($str);
        if($strlen < $length) {
            $str = str_pad($str,$length,'0');
        }
        else if($strlen > $length) {
            $str = substr($str, 0, $length);
        }
    }
}
