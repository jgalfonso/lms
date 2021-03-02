<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProjectAttachments extends Model
{
    protected $table = 'project_attachments';
    protected $primaryKey = 'attachment_id';

    /**
     * Getting project attachments by project_id
     */
    public static function getAttachments($id = null)
    {
        $attachments = self::select(
                        'project_attachments.*',
                    )
                    ->leftJoin('projects', 'project_attachments.project_id', '=', 'projects.project_id')
                    ->where('project_attachments.project_id', $id)
                    ->get();

        return !empty($attachments) ? $attachments : null;
    }
}
