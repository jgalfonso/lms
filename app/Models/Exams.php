<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Exams extends Model
{
    protected $table = 'testexam_master';
    protected $primaryKey = 'testexam_id';

    public static function getByClassID($request)
    {      
        $exams = self::where('class_id', $request->classID)
            ->whereIn('status', ['New', 'Active'])
            ->orderBy('date_added', 'desc')
            ->get();

        return $exams;
    }

    public static function getByID($request)
    {      
        $exam = self::select('testexam_master.*',  'exam_participants.exam_participant_id', 'exam_participants.attempt')
            ->join('exam_participants', function($join) 
                {
                    $join->on('exam_participants.exam_id', 'testexam_master.testexam_id');
                    $join->where('exam_participants.status', 'Active');
                })
            ->where([
                ['testexam_master.testexam_id', $request->examID],
                ['testexam_master.status', 'Active']
            ])
            ->first();

        return $exam;
    }
}



