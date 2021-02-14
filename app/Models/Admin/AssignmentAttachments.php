<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AssignmentAttachments extends Model
{
    protected $table = 'assignment_attachments';
    protected $primaryKey = 'attachment_id';

    /**
     * Getting assignment attachments by assignment_id
     */
    public static function getAttachments($id = null)
    {
        $attachments = self::select(
                        'assignment_attachments.*',
                    )
                    ->leftJoin('assignments', 'assignment_attachments.assignment_id', '=', 'assignments.assignment_id')
                    ->where('assignments.assignment_id', $id)
                    ->get();

        return !empty($attachments) ? $attachments : null;
    }
}
