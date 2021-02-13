<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Assignments extends Model
{
    protected $table = 'assignments';
    protected $primaryKey = 'assignment_id';

    /**
     * Getting all assignments
     */
    public static function getAssignments()
    {
        $assignments = self::select(
                        'assignments.*',
                        'classes.code as class_code',
                        'classes.name as class_name',
                    )
                    ->leftJoin('classes', 'assignments.class_id', '=', 'classes.class_id')
                    ->where('assignments.status', 'Active')
                    ->get();

        return !empty($assignments) ? $assignments : null;
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
                'instructor_id'     => $request->instructor,
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
             * Saving attachment of new assignment
             */
            if ($request->hasFile('attach_file')) {

                foreach ($request->file('attach_file') as $key => $value) {

                    $path = public_path() .'/assignments/' . $request->course_id . '/' . $request->class_id . '/' . $assignID . '/';

                    if (!file_exists($path)) {
                        mkdir($path,0777,TRUE);
                    }

                    $file       = $value;
                    $fileExt    = $file->getClientOriginalExtension();
                    $filename   = time().$file->getClientOriginalName();
                    $file->move($path, $filename);

                    $attach = [
                        'assignment_id' => $assignID,
                        'title'         => $request->attach_title[$key],
                        'filename'      => $filename,
                        'path'          => '/assignments/' . $request->course_id . '/' . $request->class_id . '/' . $assignID . '/',
                        'created_by'    => 1,
                        'dt_created'    => date('Y-m-d H:i:s'),
                    ];

                    $save   = DB::table('assignment_attachments')->insert($attach);
                }
            }

            DB::commit();

            return ['success' => true];

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
                    )
                    ->leftJoin('classes', 'assignments.class_id', '=', 'classes.class_id')
                    ->where('assignments.status', 'Inactive')
                    ->get();

        return !empty($assignments) ? $assignments : null;
    }
}
