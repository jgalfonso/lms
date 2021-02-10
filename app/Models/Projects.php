<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Projects extends Model
{
    protected $table = 'project_master';
    protected $primaryKey = 'project_id';

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
        $assignment = self::select('project_master.*', 'class_master.class_folder_id')
            ->join('class_master', 'class_master.class_id', 'project_master.class_id')
            ->where('project_master.project_id', $request->projectID)
            ->whereIn('project_master.status', ['New', 'Active'])
            ->first();

        return $assignment;
    }
}



