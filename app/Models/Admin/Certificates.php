<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Models\Admin\Assessments;


class Certificates extends Model
{
    protected $table = 'certificates';
    public $primaryKey = 'certificate_id';
    public $timestamps = false;
    
     public static function getSummary()
    {
        $summary = self::select(
                DB::raw('COUNT(CASE WHEN status = "New" THEN certificate_id END) new'),
                DB::raw('COUNT(CASE WHEN status = "For QA" THEN certificate_id END) qa'),
                DB::raw('COUNT(CASE WHEN status = "For Approval" THEN certificate_id END) approval'),
                DB::raw('COUNT(CASE WHEN status = "Rejected" THEN certificate_id END) rejected'),
                DB::raw('COUNT(CASE WHEN status = "Active" THEN certificate_id END) active')
            )
            ->first();

        return $summary;
    }

    public static function getEntries($status)
    {   
        $entries = self::select('certificates.*', 'classes.code AS class_code', 'classes.name AS class_name', 'courses.name AS course', 'profiles.control_no', DB::raw("CONCAT(profiles.lastname, ', ', profiles.firstname, ' ', IFNULL(profiles.middlename, '')) AS trainee"), 'assessments.date_assessed')
            ->join('courses', 'courses.course_id', 'certificates.course_id')
            ->join('classes', 'classes.class_id', 'certificates.class_id')
            ->join('assessments', 'assessments.assessment_id', 'certificates.assessment_id')
            ->join('profiles', 'profiles.profile_id', 'certificates.profile_id')
            ->where('certificates.status',$status)
            ->get();

        return $entries;
    }

    public static function getByStatus($status)
    {
        $certificates = self::select('certificates.*', 'classes.code AS class_code', 'classes.name AS class_name', 'courses.name AS course', 'profiles.control_no', DB::raw("CONCAT(profiles.lastname, ', ', profiles.firstname, ' ', IFNULL(profiles.middlename, '')) AS trainee"))
            ->join('courses', 'courses.course_id', 'certificates.course_id')
            ->join('classes', 'classes.class_id', 'certificates.class_id')
            ->join('profiles', 'profiles.profile_id', 'certificates.profile_id')
            ->where('certificates.status', $status)
            ->get();

        return $certificates;
    }

    public static function getByID($id)
    {
        $certificate = self::select('certificates.*', 'classes.code AS class_code', 'classes.name AS class_name', 'courses.name AS course', 'profiles.control_no', DB::raw("CONCAT(profiles.lastname, ', ', profiles.firstname, ' ', IFNULL(profiles.middlename, '')) AS trainee"))
            ->join('courses', 'courses.course_id', 'certificates.course_id')
            ->join('classes', 'classes.class_id', 'certificates.class_id')
            ->join('profiles', 'profiles.profile_id', 'certificates.profile_id')
            ->where('certificates.certificate_id', $id)
            ->first();

        return $certificate;
    }

    public static function add($request)
    {      
        foreach(json_decode($request->passedIDS) as $passed){
                
            $data = [
                'certificate_no' => $passed->certificateNO,
                'registration_no' => $passed->registrationNO,
                'assessment_id' => $request->assessmentID,
                'course_id'     => $request->course_id,
                'class_id'      => $request->class_id,
                'profile_id'    => $passed->profileID,
                'created_by'    => 1,
                'dt_created'    => date('Y-m-d H:i:s'),
                'issued_by'     => 1,
                'dt_issued'     => date('Y-m-d H:i:s'),
                'status'        => 'New'
            ];

            self::insert($data);
        }

        return true;
    }

    public static function moderate($request)
    {
        DB::beginTransaction();

        try {
            if($request->reviewed == 'on') { $gradeID = 7; $status = 'Reviewed'; }
            elseif($request->rejected == 'on') { $gradeID = 8; $status = 'Rejected'; }
            elseif($request->verified == 'on') { $gradeID =9; $status = 'Verified'; }
            else { $gradeID = 10; $status = 'Awarded'; }

            //Entries
            $data = [
                'grade_id'      => $gradeID,
                'prize'         => $status == 'Awarded' ? $request->prize : NULL,
                'moderated_by'  => $request->moderatorID,
                'dt_moderated'  => date('Y-m-d H:i:s'),
                'lupd_by'       => $request->userID,
                'dt_lupd'       => date('Y-m-d H:i:s'),
                'status'        => $status
            ];
            self::where('entry_id', $request->entry_id)->update($data);
            
            //Images
            BikiniContestImages::editImages($request);

            //Moderations
            $data = [
                'moderateable_type_id'  => 3,
                'reference_id'          => $request->entry_id,
                'grade_id'              => $gradeID,
                'remarks'               => $request->remarks,
                'moderator_id'          => $request->moderatorID,
                'created_by'            => $request->userID,
                'dt_created'            => date('Y-m-d H:i:s'),
                'status'                => 'Active'
            ];
            DB::table('moderations')->insert($data);

            //Transactions
             /*
            if($status == 'Published') {

                $request->request->add(['transactionTypeID' => 23]);
                $request->request->add(['referenceID' => $request->entry_id]);
                $request->request->add(['subReferenceID' => $request->profile_id]);
                $request->request->add(['amount' => $request->prize]);
                //$request->request->add(['tipJarBalance' => Auth::user()->profile->tip_jar - abs($request->amount)]);
                Transactions::add($request);

               
                DB::table('profiles')
                    ->where('profile_id', $request->profile_id)
                    ->increment('tip_jar', $request->amount, [
                        'tip_jar_validity'  => \Carbon\Carbon::now()->addYears(1)->format('Y-m-d H:i:s'),
                        'lupd_by' => $request->user_id, 
                        'dt_lupd' => date('Y-m-d H:i:s')
                    ]);

                DB::table('profiles')
                    ->where('profile_id', $request->moderatorID)
                    ->decrement('wallet', $request->amount, [
                        'lupd_by' => $request->user_id, 
                        'dt_lupd' => date('Y-m-d H:i:s')
                    ]);  
            }
            */

            //Message
            if($request->subject && $request->message) {

                if($request->send_as_email == 'on') {

                    //support@microminimus.com
                    Notification::route('mail', $request->email)
                        ->notify(new BikiniContestVerified($request->subject, $request->message));
                } else {
                    
                    $data = [
                        'sender_id'     => $request->moderatorID,
                        'recipient_id'  => $request->profile_id,
                        'subject'       => $request->subject,
                        'body'          => $request->message,
                        'dt_send'       => date('Y-m-d H:i:s'),
                        'created_by'    => $request->userID,
                        'dt_created'    => date('Y-m-d H:i:s'),
                        'dt_send'       => date('Y-m-d H:i:s'),
                        'status'        => 'New',
                    ];
                    DB::table('messages')->insert($data);
                }                
            }

            DB::commit();

            return ['success' => true];

        } catch (Exception $e) {

            DB::rollback();

            return $e->getMessage();
        }            
    }

    public static function publish($request)
    {
        DB::beginTransaction();

        try {
            $data = [
                'published_by'  => $request->publisherID,
                'dt_published'  => date('Y-m-d H:i:s'),
                'lupd_by'       => $request->userID,
                'dt_lupd'       => date('Y-m-d H:i:s'),
                'status'        => 'Published'
            ];
            self::whereIn('entry_id', explode(',', $request->entryID))->update($data);

            self::createAccount($request);

            DB::commit();

            return ['success' => true];

        } catch (Exception $e) {

            DB::rollback();

            return $e->getMessage();
        }   
    }
}
