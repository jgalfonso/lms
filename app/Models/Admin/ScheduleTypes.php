<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ScheduleTypes extends Model
{
    protected $table = 'schedule_types';
    protected $primaryKey = 'schedule_type_id';

    public static function getScheduleTypes()
    {
        $courses = self::get();

        return $courses;
    }
}