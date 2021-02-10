<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Classes extends Model
{
    protected $table = 'class_master';
    protected $primaryKey = 'class_id';

    public static function getByCode($request)
    {      
        $class = self::where('class_code', $request->classCode)
            ->whereIn('status', ['New', 'Active'])
            ->first();

        return $class;
    }

    public static function getByID($request)
    {      
        $class = self::where('class_code', $request->classCode)
            ->whereIn('status', ['New', 'Active'])
            ->first();

        return $class;
    }
}