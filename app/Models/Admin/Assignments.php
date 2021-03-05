<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Assignments extends Model
{
    protected $table = 'assignments';
    protected $primaryKey = 'assignment_id';
    public $timestamps = false;

    /**
     * Getting all assignments
     */
    public static function getAssignments()
    {
        $assignments = self::select(
                        'assignments.*',
                        'classes.code as class_code',
                        'classes.name as class_name',
                        DB::raw('CONCAT(profiles.lastname, ", ", profiles.firstname, " ", profiles.middlename) AS instructor')
                    )
                    ->leftJoin('classes', 'assignments.class_id', '=', 'classes.class_id')
                    ->leftJoin('profiles', function($join)
                        {
                            $join->on('profiles.profile_id', 'assignments.instructor_id');
                            $join->where('profiles.status', 'Active');
                        })
                    ->where('assignments.status', 'Active')
                    ->get();

        return !empty($assignments) ? $assignments : null;
    }

    /**
     * Getting assignment by id
     */
    public static function getById($assignmentID = null)
    {
        $assignment = self::select(
                        'assignments.*',
                        'classes.code as class_code',
                        'classes.name as class_name',
                        'courses.course_id as course_id',
                        'courses.name as course_name',
                        DB::raw('CONCAT(profiles.lastname, ", ", profiles.firstname, " ", profiles.middlename) AS instructor')
                    )
                    ->leftJoin('classes', 'assignments.class_id', '=', 'classes.class_id')
                    ->leftJoin('courses', 'classes.course_id', '=', 'courses.course_id')
                    ->leftJoin('profiles', function($join)
                        {
                            $join->on('profiles.profile_id', 'assignments.instructor_id');
                            $join->where('profiles.status', 'Active');
                        })
                    ->where('assignments.assignment_id', $assignmentID)
                    ->first();

        return !empty($assignment) ? $assignment : null;
    }

    /**
     * Get all assignments
     * Filtered by class
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public static function filter ($request)
    {
        $class_id = ($request->class_id != '' ? $request->class_id : null);
        $archives = (isset($request->archives) && $request->archives == 1 ? 1 : null);

        $assignments = self::select(
                        'assignments.*',
                        'classes.code as class_code',
                        'classes.name as class_name',
                    )
                    ->leftJoin('classes', 'assignments.class_id', '=', 'classes.class_id')
                    ->when($class_id, function ($query) use ($class_id) {
                        return $query->where('assignments.class_id', $class_id);
                    })
                    ->when($archives, function ($query) use ($archives) {
                        return $query->where('assignments.status', 'Inactive');
                    })
                    ->orderBy('assignments.assignment_id', 'desc');

        return !empty($assignments) ? $assignments : null;
    }

    /**
     * Saving new assignment
     */
    public static function storeAssignment($request)
    {
        DB::beginTransaction();

        try {

            /**
             * Saving new assignment to assignment table
             */
            $data = [
                'title'             => $request->title,
                'instruction'       => $request->instruction,
                'class_id'          => $request->class_id,
                'instructor_id'     => $request->instructor_id,
                'points'            => $request->points,
                'allowed_attempts'  => $request->allowed_attempts,
                'start'             => (!empty($request->start) ? date('Y-m-d H:i:s', strtotime($request->start)) : null),
                'end'               => (!empty($request->end) ? date('Y-m-d H:i:s', strtotime($request->end)) : null),
                'created_by'        => 1,
                'dt_created'        => date('Y-m-d H:i:s'),
                'status'            => 'Active',
            ];

            $save = self::insert($data);
            $assignmentID = DB::getPdo()->lastInsertId();

            /**
             * Saving attachment of new assignment
             */
            if ($request->hasFile('attach_file')) {

                foreach ($request->file('attach_file') as $key => $value) {

                    $path = public_path() .'/assignments/' . $request->course_id . '/' . $request->class_id . '/' . $assignmentID . '/';

                    if (!file_exists($path)) {
                        mkdir($path,0777,TRUE);
                    }

                    $file       = $value;
                    $fileExt    = $file->getClientOriginalExtension();
                    $filename   = time().$file->getClientOriginalName();
                    $file->move($path, $filename);

                    $attach = [
                        'assignment_id' => $assignmentID,
                        'title'         => $request->attach_title[$key],
                        'filename'      => $filename,
                        'path'          => '/assignments/' . $request->course_id . '/' . $request->class_id . '/' . $assignmentID . '/',
                        'created_by'    => 1,
                        'dt_created'    => date('Y-m-d H:i:s'),
                    ];

                    $save   = DB::table('assignment_attachments')->insert($attach);
                }
            }

            DB::commit();

            return [
                'success' => true,
                'assignment_id' => $assignmentID
            ];

        } catch (\Exception $e) {
            return ['success' => $e->getMessage()];
        }

    }

    /**
     * Getting all archives assignments
     */
    public static function getArchives()
    {
        $assignments = self::select(
                        'assignments.*',
                        'classes.code as class_code',
                        'classes.name as class_name',
                        DB::raw('CONCAT(profiles.lastname, ", ", profiles.firstname, " ", profiles.middlename) AS instructor')
                    )
                    ->leftJoin('classes', 'assignments.class_id', '=', 'classes.class_id')
                    ->leftJoin('profiles', function($join)
                        {
                            $join->on('profiles.profile_id', 'assignments.instructor_id');
                            $join->where('profiles.status', 'Active');
                        })
                    ->where('assignments.status', 'Closed')
                    ->get();

        return !empty($assignments) ? $assignments : null;
    }

    /**
     * Activate assignment/assignments
     */
    public static function activate($request)
    {
        try {

            $assignments = json_decode($request->assignmentIDS);

            foreach($assignments as $assignment){

                $data = [
                    'lupd_by'   => $request->userID,
                    'dt_lupd'   => date('Y-m-d H:i:s'),
                    'status'    => 'Active'
                ];

                self::where('assignment_id', $assignment->assignmentID)->update($data);
            }

            return ['success' => true];

        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }

    /**
     * Close assignment/assignments
     */
    public static function close($request)
    {
        try {

            $assignments = json_decode($request->assignmentIDS);

            foreach($assignments as $assignment){

                $data = [
                    'lupd_by'   => $request->userID,
                    'dt_lupd'   => date('Y-m-d H:i:s'),
                    'status'    => 'Closed'
                ];

                self::where('assignment_id', $assignment->assignmentID)->update($data);
            }

            return ['success' => true];

        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }
}
