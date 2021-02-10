<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AssignmentLinks extends Model
{
    protected $table = 'assignment_links';
    protected $primaryKey = 'link_id';

    public static function getByID($request)
    {      
        $links = self::where('assignment_id', $request->assignmentID)
            ->get();

        return $links;
    }
}



