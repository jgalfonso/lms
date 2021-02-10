<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class QuizStudentAnswer extends Model
{
    protected $table = 'quiz_student_answer';
    protected $primaryKey = 'quiz_student_answer_id';

    protected $fillable = [
        'student_id',
        'quiz_id',
        'quiz_code',
        'quiz_participant_id',
        'quiz_details_id',
        'student_answer',
        'is_correct'
    ];

    public $timestamps = false;

    public static function add($request)
    {
        try {

           	self::updateOrCreate([
        			'student_id'    		=> $request->studentID,
        			'quiz_id'       		=> $request->quizID,
        			'quiz_code'       		=> $request->quizCode,
        			'quiz_participant_id'	=> $request->quizParticipantID,
        			'quiz_details_id'       => $request->quizDetailID


        		], [
                    'student_answer'    	=> $request->answer,
                    'is_correct'            => $request->isCorrect
                ]);
            
            return ['success' => true];

        } catch (Exception $e) {

            return $e->getMessage();
        }
    }
}



