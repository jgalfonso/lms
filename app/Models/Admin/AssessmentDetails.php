<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AssessmentDetails extends Model
{
    protected $table = 'assessment_details';
    protected $primaryKey = 'system_id';
    public $timestamps = false;

    public static function add($trainees, $assessment_id)
    {
        DB::beginTransaction();

        try {

            foreach($trainees as $trainee){

                $data = [
                    'assessment_id' => $assessment_id,
                    'profile_id'    => $trainee->profile_id,
                    'passed'        => $trainee->passed,
                    'failed'        => $trainee->failed,
                    'incomplete'    => $trainee->incomplete,
                    'created_by'    => 1,
                    'dt_created'    => date('Y-m-d H:i:s'),
                    'status'        => 'Active'
                ];

                self::insert($data);
            }

            DB::commit();

            return true;

        } catch (\Exception $e) {

            DB::rollback();
            return $e->getMessage();
        }
    }

     /**
      * Get all trainees for assessment
      */
     public static function getTrainees($id = null)
     {
         $data = self::select(
                         'assessment_details.*',
                         'profiles.firstname',
                         'profiles.lastname',
                         'profiles.registration_no',
                         'profiles.email',
                         DB::raw('CONCAT(profiles.lastname, ", ", profiles.firstname) AS trainee_name'),
                     )
                     ->leftJoin('profiles', 'assessment_details.profile_id', '=', 'profiles.profile_id')
                     ->where('assessment_details.assessment_id', $id)
                     ->where('assessment_details.status', 'Active')
                     ->get();

         return !empty($data) ? $data : null;
     }
}
