<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Enrollments extends Model
{
    protected $table = 'enrollment_master';
    protected $primaryKey = 'enrollment_id';

    public static function getByRequest($studentID, $status)
    {      
        $enrollment = self::select('enrollment_master.*', 'class_master.class_code', 'class_master.class_name', 'class_master.class_type', 'teacher_master.last_name', 'teacher_master.first_name', 'teacher_master.middle_name')
            ->join('class_master', 'class_master.class_id', 'enrollment_master.class_id')
            ->leftJoin('teacher_master', 'teacher_master.teacher_id', 'class_master.teacher_id')
            ->where([
                ['enrollment_master.student_id', $studentID],
                ['enrollment_master.status',  $status]
            ])
            ->orderBy('class_master.class_name')
            ->get();

        return $enrollment;
    }

    public static function getByCode($request)
    {      
        $enrollment = self::where([
        		['class_code', $request->classCode],
        		['student_id', $request->studentID]
        	])
        	->whereIn('status', ['New', 'Active'])
        	->first();

        return $enrollment;
    }

    public static function getOverview($request)
    {      
        $enrollment = self::select('enrollment_master.*', 'class_master.class_code', 'class_master.class_name', 'class_master.class_description', 'class_master.class_type', 'class_master.class_link', 'class_master.participants', 'class_master.semester', 'teacher_master.last_name', 'teacher_master.first_name', 'teacher_master.middle_name', DB::raw('CONCAT(LEFT(teacher_master.first_name, 1), LEFT(teacher_master.last_name, 1)) initial'), 'teacher_master.email_address', 'teacher_master.fb', 'teacher_master.linkedin', 'teacher_attachment.attachment_path', 'teacher_attachment.attachment_filename')
            ->join('class_master', 'class_master.class_id', 'enrollment_master.class_id')
            ->leftJoin('teacher_master', 'teacher_master.teacher_id', 'class_master.teacher_id')
            ->leftJoin('teacher_attachment', function($join) 
                {
                    $join->on('teacher_attachment.teacher_id', 'teacher_master.teacher_id');
                    $join->where('teacher_attachment.status', 'Active');
                })
            ->where([
                ['enrollment_master.class_id', $request->classID],
                ['enrollment_master.student_id', $request->studentID],
                ['enrollment_master.status', 'Active']
            ])
            ->first();

        return $enrollment;
    }

    public static function add($request)
    {
        try {

        	$data = [
                'class_id'      => $request->classID,
                'class_code'    => $request->classCode,
                'student_id'    => $request->studentID,
                'student_no'    => $request->studentNO,
                'date_enrolled'	=> date('Y-m-d H:i:s'),
                'status'        => 'New'
            ];

            self::insert($data);
			
            return ['success' => true];

        } catch (Exception $e) {

            return $e->getMessage();
        }
    }
}