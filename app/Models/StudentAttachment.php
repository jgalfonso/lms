<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Models\Students;

class StudentAttachment extends Model
{
    protected $table = 'student_attachment';
    protected $primaryKey = 'attachment_id';

    public function student()
    {
        return $this->belongsTo(Students::class, 'student_id');
    }
}



