<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class QuizParticipants extends Model
{
    protected $table = 'quiz_participants';
    protected $primaryKey = 'quiz_participant_id';

    public $timestamps = false;

    public static function getByRequestID($request)
    {      
        $participant = self::where([
                ['student_id', $request->studentID],
                ['quiz_id', $request->quizID]
            ])
            ->orderBy('quiz_participant_id', 'desc')
            ->first();

        return $participant;
    }

    public static function getByID($request)
    {      
        $participant = self::select('quiz_participants.*' ,'quiz_master.quiz_code', 'quiz_master.quiz_name', 'quiz_master.length', 'quiz_master.allowed_attempts')
            ->join('quiz_master', 'quiz_master.quiz_id', 'quiz_participants.quiz_id')
            ->where('quiz_participants.quiz_participant_id', $request->quizParticipantID)
            ->first();

        return $participant;
    }

    public static function add($request)
    {
        try {

            $data = [
                'student_id'    => $request->studentID,
                'quiz_id'       => $request->quizID,
                'attempt'       => $request->attempt,
                'dt_start'      => date('Y-m-d H:i:s'),
                'length'        => $request->length,
                'dt_created'    => date('Y-m-d H:i:s'),
                'status'        => 'Active'
            ];

            self::insert($data);
            
            return ['success' => true];

        } catch (Exception $e) {

            return $e->getMessage();
        }
    }

    public static function edit($request)
    {
        try {

            $score = DB::table('quiz_student_answer')->where([
                    ['quiz_participant_id', $request->quizParticipantID],
                    ['is_correct', 1]
                ])->count();

            $data = [
                'score'     => $score,
                'dt_end'    => date('Y-m-d H:i:s'),
                'dt_lupd'   => date('Y-m-d H:i:s'),
                'status'    => 'Done'
            ];

            self::where('quiz_participant_id', $request->quizParticipantID)->update($data);
            
            return ['success' => true];

        } catch (Exception $e) {

            return $e->getMessage();
        }
    }
}



