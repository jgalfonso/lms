<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProjectAttachments extends Model
{
    protected $table = 'project_attachments';
    protected $primaryKey = 'proj_attachment_id';

    public static function getByID($request)
    {      
        $attachments = self::where('project_id', $request->projectID)
            ->get();

        return $attachments;
    }
}



