<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Models\Admin\AssessmentDetails;
use App\Models\Admin\Certificates;

class Assessments extends Model
{
    protected $table = 'assessments';
    protected $primaryKey = 'assessment_id';
    public $timestamps = false;

    public static function getByID($id)
    {
        $assessment = self::select('assessments.*', 'classes.code AS class_code', 'classes.name AS class_name', 'courses.name AS course', DB::raw("CONCAT(profiles.lastname, ', ', profiles.firstname, ' ', IFNULL(profiles.middlename, '')) AS assessor"))
            ->join('courses', 'courses.course_id', 'assessments.course_id')
            ->join('classes', 'classes.class_id', 'assessments.class_id')
            ->join('profiles', 'profiles.profile_id', 'assessments.assessor_id')
            ->where('assessments.assessment_id', $id)
            ->first();

        return $assessment;
    }

    /**
     * Store new assessment
     */
    public static function add($request)
    {
        DB::beginTransaction();

        try {

            $data = [
                'course_id'     => $request->course_id,
                'class_id'      => $request->class_id,
                'assessor_id'   => 1,
                'date_assessed' => date('Y-m-d H:i:s'),
                'passed'        => $request->passed,
                'failed'        => $request->failed,
                'incomplete'    => $request->incomplete,
                'trainees'      => $request->trainees,
                'created_by'    => 1,
                'dt_created'    => date('Y-m-d H:i:s'),
                'status'        => 'Active'
            ];

            $id = self::insertGetId($data);

            $trainees = json_decode($request->traineesData);

            $saveTrainees = AssessmentDetails::add($request->course_id, $request->class_id, $trainees, $id);


            $request->request->add(['assessmentID' => $id]);
            Certificates::add($request);

            if (!$saveTrainees) {
                return $saveTrainees;
            }

            DB::commit();

            return [
                'success' => true,
                'id' => $id
            ];

        } catch (\Exception $e) {

            DB::rollback();
            return $e->getMessage();
        }
    }

    /**
     * Get assessment
     */
    public static function getAssessments($id = null)
    {
        $data = self::select(
                'assessments.*',
                'classes.code as class_code',
                'classes.name as class_name',
                'classes.start',
                'classes.end',
                'assessor.firstname as assessor_firstname',
                'assessor.lastname as assessor_lastname',
                'assessor.middlename as assessor_middlename',
                DB::raw('CONCAT(instructor.lastname, ", ", instructor.firstname, " ", instructor.middlename) AS instructor'),
                'courses.name as course_name',
                'schedule_types.name AS schedule',
                DB::raw('COUNT(assessment_details.system_id) trainees'),
            )
            ->join('classes', 'assessments.class_id', '=', 'classes.class_id')
            ->leftJoin('schedule_types', 'schedule_types.schedule_type_id', 'classes.schedule_type_id')
            ->join('courses', 'assessments.course_id', '=', 'courses.course_id')
            ->join('assessment_details', 'assessments.assessment_id', '=', 'assessment_details.assessment_id')
            ->join('profiles AS instructor', 'classes.instructor_id', '=', 'instructor.profile_id')
            ->join('profiles AS assessor', 'assessments.assessor_id', '=', 'assessor.profile_id')
            ->when($id, function ($query) use ($id) {
                return $query->where('assessments.assessment_id', $id);
            })
            ->where('assessments.status', 'Active')
            ->groupBy('assessments.assessment_id');

        return $data;
    }
}
