<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Projects extends Model
{
    protected $table = 'projects';
    protected $primaryKey = 'project_id';
    public $timestamps = false;

    /**
     * Getting all projects
     */
    public static function getProjects()
    {
        $projects = self::select(
                        'projects.*',
                        'classes.code as class_code',
                        'classes.name as class_name',
                        DB::raw('CONCAT(profiles.lastname, ", ", profiles.firstname, " ", profiles.middlename) AS instructor'),
                    )
                    ->leftJoin('classes', 'projects.class_id', '=', 'classes.class_id')
                    ->leftJoin('profiles', 'projects.instructor_id', 'profiles.profile_id')
                    ->where('projects.status', 'Active')
                    ->get();

        return !empty($projects) ? $projects : null;
    }

    /**
     * Getting project by id
     */
    public static function getById($id = null)
    {
        $project = self::select(
                        'projects.*',
                        'classes.code as class_code',
                        'classes.name as class_name',
                        'courses.name as course_name',
                        DB::raw('CONCAT(profiles.lastname, ", ", profiles.firstname, " ", profiles.middlename) AS instructor'),
                    )
                    ->leftJoin('classes', 'projects.class_id', '=', 'classes.class_id')
                    ->leftJoin('courses', 'classes.course_id', '=', 'courses.course_id')
                    ->leftJoin('profiles', 'projects.instructor_id', 'profiles.profile_id')
                    ->where('projects.project_id', $id)
                    ->first();

        return !empty($project) ? $project : null;
    }

    /**
     * Get all projects
     * Filtered by class
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public static function filter ($request)
    {
        $class_id = ($request->class_id != '' ? $request->class_id : null);
        $archives = (isset($request->archives) && $request->archives == 1 ? 1 : null);

        $projects = self::select(
                        'projects.*',
                        'classes.code as class_code',
                        'classes.name as class_name',
                        DB::raw('CONCAT(profiles.lastname, ", ", profiles.firstname, " ", profiles.middlename) AS instructor'),
                    )
                    ->leftJoin('classes', 'projects.class_id', '=', 'classes.class_id')
                    ->leftJoin('profiles', 'projects.instructor_id', 'profiles.profile_id')
                    ->when($class_id, function ($query) use ($class_id) {
                        return $query->where('projects.class_id', $class_id);
                    })
                    ->when($archives, function ($query) use ($archives) {
                        return $query->where('projects.status', 'Closed');
                    })
                    ->orderBy('projects.project_id', 'desc');

        return !empty($projects) ? $projects : null;
    }

    /**
     * Saving new project
     */
    public static function storeProject($request)
    {
        DB::beginTransaction();

        try {

            /**
             * Saving new project to project table
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
            $assignID = DB::getPdo()->lastInsertId();

            /**
             * Saving attachment of new project
             */
            if ($request->hasFile('attach_file')) {

                foreach ($request->file('attach_file') as $key => $value) {

                    $path = public_path() .'/projects/' . $request->course_id . '/' . $request->class_id . '/' . $assignID . '/';

                    if (!file_exists($path)) {
                        mkdir($path,0777,TRUE);
                    }

                    $file       = $value;
                    $fileExt    = $file->getClientOriginalExtension();
                    $filename   = time().$file->getClientOriginalName();
                    $file->move($path, $filename);

                    $attach = [
                        'project_id' => $assignID,
                        'title'         => $request->attach_title[$key],
                        'filename'      => $filename,
                        'path'          => '/projects/' . $request->course_id . '/' . $request->class_id . '/' . $assignID . '/',
                        'created_by'    => $request->userID,
                        'dt_created'    => date('Y-m-d H:i:s'),
                    ];

                    $save   = DB::table('project_attachments')->insert($attach);
                }
            }

            DB::commit();

            return [
                'success' => true,
                'id'      => $assignID
            ];

        } catch (\Exception $e) {
            return ['success' => $e->getMessage()];
        }

    }

    /**
     * Getting all archives projects
     */
    public static function getArchives()
    {
        $projects = self::select(
                        'projects.*',
                        'classes.code as class_code',
                        'classes.name as class_name',
                        DB::raw('CONCAT(profiles.lastname, ", ", profiles.firstname, " ", profiles.middlename) AS instructor'),
                    )
                    ->leftJoin('classes', 'projects.class_id', '=', 'classes.class_id')
                    ->leftJoin('profiles', 'projects.instructor_id', 'profiles.profile_id')
                    ->where('projects.status', 'Closed')
                    ->get();

        return !empty($projects) ? $projects : null;
    }

    /**
     * Activate projects
     */
    public static function activate($request)
    {
        try {

            $projects = json_decode($request->projectIDs);

            foreach($projects as $proj){

                $data = [
                    'lupd_by'   => $request->userID,
                    'dt_lupd'   => date('Y-m-d H:i:s'),
                    'status'    => 'Active'
                ];

                self::where('project_id', $proj->projectID)->update($data);
            }

            return ['success' => true];

        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }

    /**
     * Close projects
     */
    public static function close($request)
    {
        try {

            $projects = json_decode($request->projectIDs);

            foreach($projects as $proj){

                $data = [
                    'lupd_by'   => $request->userID,
                    'dt_lupd'   => date('Y-m-d H:i:s'),
                    'status'    => 'Closed'
                ];

                self::where('project_id', $proj->projectID)->update($data);
            }

            return ['success' => true];

        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }
}
