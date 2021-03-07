<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AssignmentParticipants extends Model
{
    protected $table = 'assignment_participants';
    protected $primaryKey = 'participant_id';
    public $timestamps = false;

    /**
     * Get all participant assignments
     */
    public static function getParticipants()
    {
        $participants = self::select(
                        'assignment_participants.*',
                        'assignments.title as assignment',
                        'classes.code as class_code',
                        'classes.name as class_name',
                        'profiles.reference_no as student_no',
                        DB::raw('CONCAT(profiles.lastname, ", ", profiles.firstname, " ", profiles.middlename) AS student')
                    )
                    ->leftJoin('assignments', 'assignment_participants.assignment_id', '=', 'assignments.assignment_id')
                    ->leftJoin('classes', 'assignment_participants.class_id', '=', 'classes.class_id')
                    ->leftJoin('profiles', function($join)
                        {
                            $join->on('profiles.profile_id', 'assignment_participants.student_id');
                            $join->where('profiles.status', 'Active');
                        })
                    ->get();

        return !empty($participants) ? $participants : null;
    }

    /**
     * Get participant by id
     */
    public static function getByID($participantID = null)
    {
        $participant = self::select(
                        'assignment_participants.*',
                        'assignments.title as assignment',
                        'assignments.allowed_attempts',
                        'classes.code as class_code',
                        'classes.name as class_name',
                        'courses.name as course_name',
                        'profiles.reference_no as student_no',
                        DB::raw('CONCAT(profiles.lastname, ", ", profiles.firstname, " ", profiles.middlename) AS student')
                    )
                    ->leftJoin('assignments', 'assignment_participants.assignment_id', '=', 'assignments.assignment_id')
                    ->leftJoin('classes', 'assignment_participants.class_id', '=', 'classes.class_id')
                    ->leftJoin('courses', 'classes.course_id', '=', 'courses.course_id')
                    ->leftJoin('profiles', function($join)
                        {
                            $join->on('profiles.profile_id', 'assignment_participants.student_id');
                            $join->where('profiles.status', 'Active');
                        })
                    ->first();

        return !empty($participant) ? $participant : null;
    }

    /**
     * Get all participants
     * Filtered by class
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public static function filter ($request)
    {
        $class_id = ($request->class_id != '' ? $request->class_id : null);

        $participants = self::select(
                        'assignment_participants.*',
                        'assignments.title as assignment',
                        'classes.code as class_code',
                        'classes.name as class_name',
                        'profiles.reference_no as student_no',
                        DB::raw('CONCAT(profiles.lastname, ", ", profiles.firstname, " ", profiles.middlename) AS student')
                    )
                    ->leftJoin('assignments', 'assignment_participants.assignment_id', '=', 'assignments.assignment_id')
                    ->leftJoin('classes', 'assignment_participants.class_id', '=', 'classes.class_id')
                    ->leftJoin('courses', 'classes.course_id', '=', 'courses.course_id')
                    ->leftJoin('profiles', function($join)
                        {
                            $join->on('profiles.profile_id', 'assignment_participants.student_id');
                            $join->where('profiles.status', 'Active');
                        })
                    ->when($class_id, function ($query) use ($class_id) {
                        return $query->where('assignment_participants.class_id', $class_id);
                    })
                    ->orderBy('assignment_participants.assignment_id', 'desc');

        return !empty($participants) ? $participants : null;
    }

    /**
     * Set assignment to complete
     */
    public static function complete($request)
    {
        // dd($request);
        try {

            $participants = json_decode($request->participantIDS);

            foreach($participants as $participant){

                $data = [
                    'lupd_by'   => $request->userID,
                    'date_lupd' => date('Y-m-d H:i:s'),
                    'status'    => 'Completed'
                ];

                self::where('participant_id', $participant->participantID)->update($data);
            }

            return ['success' => true];

        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }
}
