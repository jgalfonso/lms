<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Classes extends Model
{
    protected $table = 'classes';
    protected $primaryKey = 'class_id';

    /**
     * Getting all courses
     */
    public static function getByCourse($request = null)
    {
        $classes = self::where('course_id', $request->course_id)
                    ->where('status', 'Active')
                    ->get();

        return !empty($classes) ? $classes : null;
    }
}
