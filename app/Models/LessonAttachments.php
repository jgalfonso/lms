<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LessonAttachments extends Model
{
    protected $table = 'lesson_attachments';
    protected $primaryKey = 'lesson_attachment_id';

    public static function getByID($request)
    {      
        $attachments = self::where('lesson_id', $request->lessonID)
            ->get();

        return $attachments;
    }
}



