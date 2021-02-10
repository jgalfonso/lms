<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class QuizChoices extends Model
{
    protected $table = 'quiz_choices';
    protected $primaryKey = 'quiz_choices_id';

    public static function getByQuizDetailID($request)
    {      
        $choices = self::where('quiz_details_id', $request->quizDetailID)
            ->get();

        return $choices;
    }
}



