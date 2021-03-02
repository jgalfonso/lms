<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Models\Admin\AssessmentDetails;

class Assessments extends Model
{
    protected $table = 'assessments';
    protected $primaryKey = 'assessment_id';
    public $timestamps = false;

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

            $saveTrainees = AssessmentDetails::add($trainees, $id);

            if (!$saveTrainees) {
                return $saveTrainees;
            }

            DB::commit();

            return ['success' => true];

        } catch (\Exception $e) {

            DB::rollback();
            return $e->getMessage();
        }
    }

    /**
     * Get assessment
     */
    public static function getAssessment($id = null)
    {
        $data = self::select(
                        'assessments.*',
                        'classes.code as class_code',
                        'classes.name as class_name',
                        'assessor.firstname as assessor_firstname',
                        'assessor.lastname as assessor_lastname',
                        'assessor.middlename as assessor_middlename',
                        DB::raw('CONCAT(instructor.lastname, ", ", instructor.firstname, " ", instructor.middlename) AS instructor'),
                        'courses.name as course_name',
                        'schedule_types.name AS schedule'
                    )
                    ->leftJoin('classes', 'assessments.class_id', '=', 'classes.class_id')
                    ->leftJoin('schedule_types', 'schedule_types.schedule_type_id', 'classes.schedule_type_id')
                    ->leftJoin('courses', 'assessments.course_id', '=', 'courses.course_id')
                    ->leftJoin('profiles AS instructor', 'classes.instructor_id', '=', 'instructor.profile_id')
                    ->leftJoin('profiles AS assessor', 'assessments.assessor_id', '=', 'assessor.profile_id')
                    ->where('assessments.assessment_id', $id)
                    ->where('assessments.status', 'Active')
                    ->first();

        return !empty($data) ? $data : null;
    }
}
