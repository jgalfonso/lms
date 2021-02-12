<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Courses extends Model
{
    protected $table = 'courses';
    protected $primaryKey = 'course_id';

    /**
     * Getting all courses
     */
    public static function getCourses()
    {
        $courses = self::where('status', 'Active')
                    ->get();

        return !empty($courses) ? $courses : null;
    }
}
