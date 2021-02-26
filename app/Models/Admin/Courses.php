<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Courses extends Model
{
    protected $table = 'courses';
    protected $primaryKey = 'course_id';
    public $timestamps = false;
    
    public static function getCourses()
    {
        $courses = self::where('status', 'Active')->get();

        return $courses;
    }

    public static function getByID($courseID)
    {      
        $course = self::where('course_id', $courseID)->first();

        return $course;
    }

    public static function add($request)
    {      
       try {

            $data = [
                'name'              => $request->name,
                'created_by'        => $request->userID,
                'dt_created'        => date('Y-m-d H:i:s'),
                'status'            => 'Active'
            ];

            $id = self::insertGetId($data);

            return ['success' => true, 'id' => $id];

        } catch (\Exception $e) {
            
            return $e->getMessage();
        }
    }

    public static function edit($request)
    {      
        try {

            $data = [
                'name'              => $request->name,
                'lupd_by'           => $request->userID,
                'dt_lupd'           => date('Y-m-d H:i:s')
            ];

            self::where('course_id', $request->courseID)->update($data);

            return ['success' => true, 'id' => $request->courseID];

        } catch (\Exception $e) {
            
            return $e->getMessage();
        }
    }
}
