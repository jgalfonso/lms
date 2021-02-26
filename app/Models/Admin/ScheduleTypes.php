<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ScheduleTypes extends Model
{
    protected $table = 'schedule_types';
    protected $primaryKey = 'schedule_type_id';

    /**
     * Getting all schedule types
     */
    public static function getSchedTypes()
    {
        $scheds = self::select(
                        'schedule_types.*',
                    )
                    ->get();

        return !empty($scheds) ? $scheds : null;
    }
}
