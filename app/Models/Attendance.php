<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Attendance extends Model
{
    protected $table = 'attendance_master';
    protected $primaryKey = 'attendance_id';

    public static function getByRequestID($request)
    {      
        $exams = self::select('attendance_master.*', DB::raw("CONCAT(MONTHNAME(attendance_date), ' ', YEAR(attendance_date)) months"))
            ->where([
                ['class_id', $request->classID],
                ['student_id', $request->studentID]
            ])
            ->orderBy('attendance_date', 'desc')
            ->get();

        return $exams;
    }
}



