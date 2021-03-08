<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Models\Admin\Assessments;
use App\Models\Admin\Certificates;

class Moderations extends Model
{
    protected $table = 'moderations';
    public $primaryKey = 'moderation_id';
    public $timestamps = false;

     public static function getModerations($id) 
    {
        $moderations = self::select('moderations.*', DB::raw("CONCAT(profiles.lastname, ', ', profiles.firstname, ' ', IFNULL(profiles.middlename, '')) AS moderator"), 'grades.name as grade')
            ->join('profiles', 'moderations.created_by', 'profiles.profile_id')
            ->join('grades', 'moderations.grade_id', 'grades.grade_id')
            ->where('moderations.certificate_id', $id)
            ->orderBy('moderations.dt_created', 'DESC')
            ->get();

        return $moderations;
    }

    public static function add($request)
    {
        DB::beginTransaction();

        try {
            if ($request->gradeID) {

                $certificates = json_decode($request->certificateIDS);

                foreach($certificates as $certificate){

                    $data = [
                        'grade_id'      => $request->gradeID,
                        'lupd_by'       => $request->userID,
                        'dt_lupd'       => date('Y-m-d H:i:s'),
                        'status'        => $request->status
                    ];
                    Certificates::where('certificate_id', $certificate->certificateID)->update($data);
                }

                $data = [
                    'certificate_id'    => $certificate->certificateID,
                    'date_moderated'    => date('Y-m-d H:i:s'),
                    'grade_id'          => $request->gradeID,
                    'created_by'        => $request->userID,
                    'dt_created'        => date('Y-m-d H:i:s'),
                    'status'            => 'Active'
                ];
                self::insert($data);

            } else {

                if($request->forQA == 'on') { $gradeID = 1; $status = 'For QA'; }
                elseif($request->forApproval == 'on') { $gradeID = 2; $status = 'For Approval'; }
                elseif($request->rejected == 'on') { $gradeID = 5; $status = 'Rejected'; }
                elseif($request->revertToQA == 'on') { $gradeID = 1; $status = 'For QA'; }
                elseif($request->approved == 'on') { $gradeID = 3; $status = 'Active'; }
                else { $gradeID = 4; $status = 'Published'; }

                $data = [
                    'grade_id'      => $gradeID,
                    'lupd_by'       => $request->userID,
                    'dt_lupd'       => date('Y-m-d H:i:s'),
                    'status'        => $status
                ];
                Certificates::where('certificate_id', $request->certificateID)->update($data);

                $data = [
                    'certificate_id'    => $request->certificateID,
                    'date_moderated'    => date('Y-m-d H:i:s', strtotime($request->dateModerated)),
                    'grade_id'          => $gradeID,
                    'remarks'           => $request->remarks,
                    'created_by'        => $request->userID,
                    'dt_created'        => date('Y-m-d H:i:s'),
                    'status'            => 'Active'
                ];
                self::insert($data);
            }

            DB::commit();

            return ['success' => true];

        } catch (Exception $e) {

            DB::rollback();

            return $e->getMessage();
        }            
    }
}
