<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LessonAttachments extends Model
{
    protected $table = 'lesson_attachments';
    protected $primaryKey = 'attachment_id';

    /**
     * Getting lesson attachments by lesson_id
     */
    public static function getAttachments($id = null)
    {
        $attach = self::select(
                        'lesson_attachments.*',
                    )
                    ->leftJoin('lessons', 'lesson_attachments.lesson_id', '=', 'lessons.lesson_id')
                    ->where('lesson_attachments.lesson_id', $id)
                    ->get();

        return !empty($attach) ? $attach : null;
    }
}
