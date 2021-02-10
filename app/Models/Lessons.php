<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Lessons extends Model
{
    protected $table = 'lesson_master';
    protected $primaryKey = 'lesson_id';

    public static function getByClassID($request)
    {      
        $lessons = self::select('lesson_master.*', DB::raw('WEEK(date_added) weeks'))
            ->where('class_id', $request->classID)
            ->whereIn('status', ['New', 'Active'])
            ->orderBy('weeks', 'desc')
            ->orderBy('date_added', 'desc')
            ->get();

        return $lessons;
    }

    public static function getByID($request)
    {      
        $lesson = self::select('lesson_master.*', 'class_master.class_link')
            ->join('class_master', 'class_master.class_id', 'lesson_master.class_id')
            ->where([
                ['lesson_master.lesson_id', $request->lessonID],
                ['lesson_master.status', 'Active']
            ])            
            ->first();

        return $lesson;
    }
}



