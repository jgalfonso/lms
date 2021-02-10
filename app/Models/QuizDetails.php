<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class QuizDetails extends Model
{
    protected $table = 'quiz_details';
    protected $primaryKey = 'quiz_details_id';

    public static function getByRequestID($request)
    {      
        $quizzes = self::select('quiz_details.*', 'quiz_student_answer.student_answer', 'quiz_student_answer.is_correct', 'quiz_answer_master.quiz_answer')
            ->leftJoin('quiz_answer_master', 'quiz_answer_master.quiz_details_id', 'quiz_details.quiz_details_id')
        	->leftJoin('quiz_student_answer', function($join) use($request)
                {
                    $join->where('quiz_student_answer.student_id', $request->studentID);
                    $join->on('quiz_student_answer.quiz_id', 'quiz_details.quiz_id');
                    $join->where('quiz_student_answer.quiz_participant_id', $request->quizParticipantID);
                    $join->on('quiz_student_answer.quiz_details_id', 'quiz_details.quiz_details_id');
                })
        	->where('quiz_details.quiz_id', $request->quizID)
            ->orderBy('quiz_details.quiz_details_number')
            ->get();

        return $quizzes;
    }
}



