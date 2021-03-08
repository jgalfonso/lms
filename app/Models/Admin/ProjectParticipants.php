<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProjectParticipants extends Model
{
    protected $table = 'project_participants';
    protected $primaryKey = 'participant_id';
    public $timestamps = false;

    /**
     * Get all participant projects
     */
    public static function getParticipants()
    {
        $projSub = DB::table('project_attachments')
            ->select(DB::raw('COUNT(project_id) attachments'), 'project_id')
            ->groupBy('project_id');

        $participants = self::select(
                        'project_participants.*',
                        'projects.title as project',
                        'classes.code as class_code',
                        'classes.name as class_name',
                        'profiles.reference_no as student_no',
                        DB::raw('CONCAT(profiles.lastname, ", ", profiles.firstname, " ", profiles.middlename) AS student'),
                        'projSub.attachments'
                    )
                    ->leftJoin('projects', 'project_participants.project_id', '=', 'projects.project_id')
                    ->leftJoinSub($projSub, 'projSub', function ($join) {
                        $join->on('projSub.project_id', 'projects.project_id');
                    })
                    ->leftJoin('classes', 'project_participants.class_id', '=', 'classes.class_id')
                    ->leftJoin('profiles', function($join)
                        {
                            $join->on('profiles.profile_id', 'project_participants.student_id');
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
                        'project_participants.*',
                        'projects.title as project',
                        'projects.allowed_attempts',
                        'classes.code as class_code',
                        'classes.name as class_name',
                        'courses.name as course_name',
                        'profiles.reference_no as student_no',
                        DB::raw('CONCAT(profiles.lastname, ", ", profiles.firstname, " ", profiles.middlename) AS student')
                    )
                    ->leftJoin('projects', 'project_participants.project_id', '=', 'projects.project_id')
                    ->leftJoin('classes', 'project_participants.class_id', '=', 'classes.class_id')
                    ->leftJoin('courses', 'classes.course_id', '=', 'courses.course_id')
                    ->leftJoin('profiles', function($join)
                        {
                            $join->on('profiles.profile_id', 'project_participants.student_id');
                            $join->where('profiles.status', 'Active');
                        })
                    ->where('project_participants.participant_id', $participantID)
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
        $keyword  = ($request->keyword != '' ? $request->keyword : null);

        $projSub = DB::table('project_attachments')
            ->select(DB::raw('COUNT(project_id) attachments'), 'project_id')
            ->groupBy('project_id');

        $participants = self::select(
                        'project_participants.*',
                        'projects.title as project',
                        'classes.code as class_code',
                        'classes.name as class_name',
                        'profiles.reference_no as student_no',
                        DB::raw('CONCAT(profiles.lastname, ", ", profiles.firstname, " ", profiles.middlename) AS student'),
                        'projSub.attachments'
                    )
                    ->leftJoin('projects', 'project_participants.project_id', '=', 'projects.project_id')
                    ->leftJoin('classes', 'project_participants.class_id', '=', 'classes.class_id')
                    ->leftJoin('courses', 'classes.course_id', '=', 'courses.course_id')
                    ->leftJoin('profiles', function($join)
                        {
                            $join->on('profiles.profile_id', 'project_participants.student_id');
                            $join->where('profiles.status', 'Active');
                        })
                    ->leftJoinSub($projSub, 'projSub', function ($join) {
                        $join->on('projSub.project_id', 'projects.project_id');
                    })
                    ->when($class_id, function ($query) use ($class_id) {
                        return $query->where('project_participants.class_id', $class_id);
                    })
                    ->when($keyword, function ($query) use ($keyword) {
                        return  $query->where(function($q) use ($keyword) {
                            $q->where('profiles.lastname', 'LIKE', "%{$keyword}%")
                                ->orWhere('profiles.firstname', 'LIKE', "%{$keyword}%")
                                ->orWhere('profiles.middlename', 'LIKE', "%{$keyword}%")
                                ->orWhere('profiles.reference_no', 'LIKE', "%{$keyword}%");
                        });
                    })
                    ->orderBy('project_participants.participant_id', 'desc');

        return !empty($participants) ? $participants : null;
    }

    /**
     * Set projects to complete
     */
    public static function complete($request)
    {
        try {

            $data = [
                'lupd_by'   => $request->userID,
                'date_lupd' => date('Y-m-d H:i:s'),
                'status'    => 'Completed'
            ];

            self::where('participant_id', $request->participantID)->update($data);

            return ['success' => true];

        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }
}
