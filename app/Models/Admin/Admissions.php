<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Models\Admin\AdmissionDetails;

class Admissions extends Model
{
    protected $table = 'admissions';
    protected $primaryKey = 'admission_id';
    public $timestamps = false;

    public static function getPending($admissionID)
    {
        $admissions = self::select('admissions.*', 'courses.name AS course', 'classes.code AS class_code', 'classes.name AS class_name')
            ->join('courses', 'courses.course_id', 'admissions.course_id')
            ->join('admission_details', function($join) 
                {
                    $join->on('admission_details.admission_id', 'admissions.admission_id');
                    $join->whereIn('admission_details.status', ['New', 'Active', 'Assessed']);
                })
            ->join('classes', 'classes.class_id', 'admission_details.class_id')
            ->where([
                ['admissions.admission_id', $admissionID],
                ['admissions.status',  'Active']
            ])
            ->get();

        return $admissions;
    }

    public static function add($request)
    {      
        DB::beginTransaction();

        try {

            $data = [
                'profile_id'        => $request->profileID,
                'course_id'         => $request->courseID,
                'date_enrolled'     => date('Y-m-d H:i:s'),
                'created_by'        => $request->userID,
                'dt_created'        => date('Y-m-d H:i:s'),
                'status'            => 'Active'
            ];

            $id = self::insertGetId($data);
            self::where('admission_id', $id)->update(['code' => sprintf('%010s', $id)]);

            foreach(json_decode($request->classIDS) as $class){
                
                $request->request->add(['admissionID' => $id]);
                $request->request->add(['classID' => $class->classID]);
                AdmissionDetails::add($request);
            }

            DB::commit();

            return ['success' => true, 'profile_id' => $request->profileID, 'admission_id' => $id];

        } catch (\Exception $e) {
            
            DB::rollback();
            return $e->getMessage();
        }
    }



    /**
     * Getting all admissions
     */
    public static function getAdmission()
    {
        $admins = self::select(
                        'admissions.*',
                        'classes.code as class_code',
                        'classes.name as class_name',
                        'profiles.firstname',
                        'profiles.lastname',
                        'courses.name as course_name',
                    )
                    ->leftJoin('classes', 'admissions.class_id', '=', 'classes.class_id')
                    ->leftJoin('courses', 'admissions.course_id', '=', 'courses.course_id')
                    ->leftJoin('profiles', 'admissions.profile_id', '=', 'profiles.profile_id')
                    ->where('admissions.status', 'Active')
                    ->get();

        return !empty($admins) ? $admins : null;
    }

    /**
     * Getting all admissions by course
     */
    public static function getByCourse($request)
    {
        $admins = self::select(
                        'admissions.*',
                        'classes.code as class_code',
                        'classes.name as class_name',
                        'profiles.firstname',
                        'profiles.lastname',
                        'courses.name as course_name',
                    )
                    ->leftJoin('classes', 'admissions.class_id', '=', 'classes.class_id')
                    ->leftJoin('courses', 'admissions.course_id', '=', 'courses.course_id')
                    ->leftJoin('profiles', 'admissions.profile_id', '=', 'profiles.profile_id')
                    ->where('admissions.status', 'Active')
                    ->where('admissions.course_id', $request->course_id)
                    ->get();

        return !empty($admins) ? $admins : null;
    }

    /**
     * Getting all admissions by class
     */
    public static function getByClass($request)
    {
        $admins = self::select(
                        'admissions.*',
                        'profiles.firstname',
                        'profiles.lastname',
                        'profiles.email',
                        'profiles.registration_no',
                    )
                    ->leftJoin('profiles', 'admissions.profile_id', '=', 'profiles.profile_id')
                    ->where('admissions.status', 'Active')
                    ->where('admissions.class_id', $request->class_id)
                    ->get();

        return !empty($admins) ? $admins : null;
    }
}
