<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\StudentAttachment;

class Students extends Model
{
    protected $table = 'student_master';
    protected $primaryKey = 'student_id';

    public function user()
    {
        return $this->belongsTo(User::class, 'reference_id', 'student_id');
    }

    public function attachment()
    {
        return $this->hasOne(StudentAttachment::class, 'student_id');
    }

    public static function getByID($studentID)
    {      
        $student = self::select('student_master.*', 'student_attachment.attachment_path', 'student_attachment.attachment_filename')
             ->leftJoin('student_attachment', function($join) 
                {
                    $join->on('student_attachment.student_id', 'student_master.student_id');
                    $join->where('student_attachment.status', 'Active');
                })
            ->where('student_master.student_id', $studentID)
            ->first();

        return $student;
    }    

    public static function getByCourseID($request)
    {      
        $students = self::select('student_master.*', 'enrollment_master.class_id', 'class_master.class_name', 'student_attachment.attachment_path', 'student_attachment.attachment_filename')
            ->join('enrollment_master', function($join) use ($request)
                {
                    $join->on('enrollment_master.student_id', 'student_master.student_id');
                    $join->where('enrollment_master.class_id', $request->classID);
                    $join->where('enrollment_master.status', 'Active');
                })
            ->join('class_master', 'class_master.class_id', 'enrollment_master.class_id')
            ->leftJoin('student_attachment', function($join) 
                {
                    $join->on('student_attachment.student_id', 'student_master.student_id');
                    $join->where('student_attachment.status', 'Active');
                })
            ->where([
                ['student_master.course_id', $request->courseID],
                ['student_master.status',  'Active']
            ])
            ->get();

        return $students;
    }    
}



