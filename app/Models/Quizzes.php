<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Quizzes extends Model
{
    protected $table = 'quiz_master';
    protected $primaryKey = 'quiz_id';

    public static function getByClassID($request)
    {      
        $quizzes = self::where('class_id', $request->classID)
            ->whereIn('status', ['New', 'Active'])
            ->orderBy('date_added', 'desc')
            ->get();

        return $quizzes;
    }

    public static function getByID($request)
    {      
        $quiz = self::select('quiz_master.*',  'quiz_participants.quiz_participant_id', 'quiz_participants.attempt')
            ->join('quiz_participants', function($join) 
                {
                    $join->on('quiz_participants.quiz_id', 'quiz_master.quiz_id');
                    $join->where('quiz_participants.status', 'Active');
                })
            ->where([
                ['quiz_master.quiz_id', $request->quizID],
                ['quiz_master.status', 'Active']
            ])
            ->first();

        return $quiz;
    }
}



