<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Assignments extends Model
{
    protected $table = 'assignment_master';
    protected $primaryKey = 'assignment_id';

    public static function getByClassID($request)
    {      
        $assignments = self::where('class_id', $request->classID)
            ->whereIn('status', ['New', 'Active'])
            ->orderBy('date_added', 'desc')
            ->get();

        return $assignments;
    }

    public static function getByID($request)
    {      
        $assignment = self::select('assignment_master.*', 'class_master.class_folder_id')
            ->join('class_master', 'class_master.class_id', 'assignment_master.class_id')
            ->where('assignment_master.assignment_id', $request->assignmentID)
            ->whereIn('assignment_master.status', ['New', 'Active'])
            ->first();

        return $assignment;
    }
}



