<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LessonLinks extends Model
{
    protected $table = 'lesson_links';
    protected $primaryKey = 'link_id';

    /**
     * Getting lesson links by lesson_id
     */
    public static function getLinks($id = null)
    {
        $links = self::select(
                        'lesson_links.*',
                    )
                    ->leftJoin('lessons', 'lesson_links.lesson_id', '=', 'lessons.lesson_id')
                    ->where('lesson_links.lesson_id', $id)
                    ->get();

        return !empty($links) ? $links : null;
    }
}
