<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProjectLinks extends Model
{
    protected $table = 'project_links';
    protected $primaryKey = 'proj_link_id';

    public static function getByID($request)
    {      
        $links = self::where('project_id', $request->projectID)
            ->get();

        return $links;
    }
}



