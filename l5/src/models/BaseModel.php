<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model {

    // %FIXME: Use late static bindings for this: http://php.net/manual/en/language.oop5.late-static-bindings.php
    // %FIXME: better way to do this
    public static function getValidationRules()
    {
        $rules = self::$rules;
        return $rules;
    }

}
