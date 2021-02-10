<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LessonLinks extends Model
{
    protected $table = 'lesson_links';
    protected $primaryKey = 'link_id';

    public static function getByID($request)
    {      
        $links = self::where('lesson_id', $request->lessonID)
            ->get();

        return $links;
    }
}



