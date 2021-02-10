<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Announcements extends Model
{
    protected $table = 'announcements';
    protected $primaryKey = 'announcement_id';

    public static function getByRequest($request)
    {      
        $announcements = self::where([
        		['announcement_type_id', $request->announcementTypeID],
                ['reference_id', $request->referenceID],
        		['status', 'Active']
        	])
        	->orderBy('dt_created', 'desc')
            ->get();

        return $announcements;
    }

    public static function getByID($request)
    {      
        $announcement = self::select('announcements.*', 'class_master.class_link')
            ->join('class_master', 'class_master.class_id', 'announcements.reference_id')
            ->where([
                ['announcements.announcement_id', $request->announcementID],
                ['announcements.status', 'Active']
            ])->first();

        return $announcement;
    }
}



