<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Classes extends Model
{
    protected $table = 'classes';
    protected $primaryKey = 'class_id';
    public $timestamps = false;

    public static function getClasses()
    {
        $classes = self::select('classes.*', 'courses.name AS course', DB::raw('CONCAT(profiles.lastname, ", ", profiles.firstname, " ", profiles.middlename) AS instructor'))
            ->join('courses', 'courses.course_id', 'classes.course_id')
            ->leftJoin('profiles', function($join)
                {
                    $join->on('profiles.profile_id', 'classes.instructor_id');
                    $join->where('profiles.status', 'Active');
                })
            ->where('classes.status', 'Active')
            ->get();

        return $classes;
    }

    public static function getByID($classID)
    {
        $class = self::select('classes.*',
                    'courses.name AS course',
                    'courses.course_id AS course_id',
                    DB::raw('CONCAT(profiles.lastname, ", ", profiles.firstname, " ", profiles.middlename) AS instructor'),
                    'schedule_types.name AS schedule')
            ->join('courses', 'courses.course_id', 'classes.course_id')
            ->join('profiles', 'profiles.profile_id', 'classes.instructor_id')
            ->leftJoin('schedule_types', 'schedule_types.schedule_type_id', 'classes.schedule_type_id')
            ->where('classes.class_id', $classID)
            ->first();

        return $class;
    }
    
    public static function getSummary($courseID)
    {
        $classes = self::select('classes.*', 'courses.name AS course', DB::raw('CONCAT(profiles.lastname, ", ", profiles.firstname, " ", profiles.middlename) AS instructor'), DB::raw('COUNT(admission_details.admission_id) AS enrollees'))
            ->join('courses', 'courses.course_id', 'classes.course_id')
            ->leftJoin('profiles', function($join) 
                {
                    $join->on('profiles.profile_id', 'classes.instructor_id');
                    $join->where('profiles.status', 'Active');
                })
            ->join('admission_details', 'admission_details.class_id', 'classes.class_id')
            ->where([
                ['classes.course_id', $courseID],
                ['classes.status', 'Active']
            ])
            ->groupBY('classes.class_id')
            ->get();

        return $classes;
    }

    public static function getByCourseID($courseID)
    {
        $classes = self::select('classes.*', 'courses.name AS course', DB::raw('CONCAT(profiles.lastname, ", ", profiles.firstname, " ", profiles.middlename) AS instructor'))
            ->join('courses', 'courses.course_id', 'classes.course_id')
            ->leftJoin('profiles', function($join)
                {
                    $join->on('profiles.profile_id', 'classes.instructor_id');
                    $join->where('profiles.status', 'Active');
                })
            ->where([
                ['classes.course_id', $courseID],
                ['classes.status', 'Active']
            ])->get();

        return $classes;
    }

    public static function activate($request)
    {
        try {

            $classes = json_decode($request->classIDS);

            foreach($classes as $class){

                $data = [
                    'lupd_by'   => $request->userID,
                    'dt_lupd'   => date('Y-m-d H:i:s'),
                    'status'    => 'Active'
                ];

                self::where('class_id', $class->classID)->update($data);
            }

            return ['success' => true];

        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }

    public static function close($request)
    {
        try {

            $classes = json_decode($request->classIDS);

            foreach($classes as $class){

                $data = [
                    'lupd_by'   => $request->userID,
                    'dt_lupd'   => date('Y-m-d H:i:s'),
                    'status'    => 'Closed'
                ];

                self::where('class_id', $class->classID)->update($data);
            }

            return ['success' => true];

        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }

    public static function add($request)
    {
        DB::beginTransaction();

        try {

            $data = [
                'name'              => $request->name,
                'description'       => $request->description,
                'class_type_id'     => $request->classTypeID,
                'course_id'         => $request->courseID,
                'instructor_id'     => $request->instructorID,
                'units'             => $request->units,
                'google_meet_link'  => $request->googleMeetLink,
                'schedule_type_id'  => $request->scheduleTypeID,
                'created_by'        => $request->userID,
                'dt_created'        => date('Y-m-d H:i:s'),
                'status'            => 'Active'
            ];

            $id = self::insertGetId($data);

            self::where('class_id', $id )->update(['code' => sprintf('%010s', $id)]);

            DB::commit();

            return ['success' => true, 'id' => $id];

        } catch (\Exception $e) {

            DB::rollback();
            return $e->getMessage();
        }
    }

    public static function edit($request)
    {
        DB::beginTransaction();

        try {

            $data = [
                'name'              => $request->name,
                'description'       => $request->description,
                'class_type_id'     => $request->classTypeID,
                'course_id'         => $request->courseID,
                'instructor_id'     => $request->instructorID,
                'units'             => $request->units,
                'google_meet_link'  => $request->googleMeetLink,
                'schedule_type_id'  => $request->scheduleTypeID,
                'lupd_by'           => $request->userID,
                'dt_lupd'           => date('Y-m-d H:i:s')
            ];

            self::where('class_id', $request->classID)->update($data);

            DB::commit();

            return ['success' => true, 'id' => $request->classID];

        } catch (\Exception $e) {

            DB::rollback();
            return $e->getMessage();
        }
    }


    /**
     * Getting all classes by course
     */
    public static function getByCourse($request = null)
    {
        $classes = self::where('course_id', $request->course_id)
                    ->where('status', 'Active')
                    ->get();

        return !empty($classes) ? $classes : null;
    }

}
