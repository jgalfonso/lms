<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AssignmentAttachments extends Model
{
    protected $table = 'assignment_attachments';
    protected $primaryKey = 'attachment_id';

    public static function getByID($request)
    {      
        $attachments = self::where('assignment_id', $request->assignmentID)
            ->get();

        return $attachments;
    }
}



