<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Exams extends Model
{
    protected $table = 'exams';
    protected $primaryKey = 'exam_id';

    /**
     * Getting all exams
     */
    public static function getExams()
    {
        $exams = self::select(
                        'exams.*',
                        'classes.code as class_code',
                        'classes.name as class_name',
                    )
                    ->leftJoin('classes', 'exams.class_id', '=', 'classes.class_id')
                    ->where('exams.status', 'Active')
                    ->get();

        return !empty($exams) ? $exams : null;
    }

    /**
     * Getting assignment by id
     */
    public static function getById($id = null)
    {
        $exam = self::select(
                        'exams.*',
                        'classes.code as class_code',
                        'classes.name as class_name',
                    )
                    ->leftJoin('classes', 'exams.class_id', '=', 'classes.class_id')
                    ->where('exams.exam_id', $id)
                    ->first();

        return !empty($exam) ? $exam : null;
    }

    /**
     * Get all exams
     * Filtered by class
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public static function filter ($request)
    {
        $class_id = $request->class_id;
        $archives = (isset($request->archives) && $request->archives == 1 ? 1 : null);

        $exams = self::select(
                        'exams.*',
                        'classes.code as class_code',
                        'classes.name as class_name',
                    )
                    ->leftJoin('classes', 'exams.class_id', '=', 'classes.class_id')
                    ->when($class_id, function ($query) use ($class_id) {
                        return $query->where('exams.class_id', $class_id);
                    })
                    ->when($archives, function ($query) use ($archives) {
                        return $query->where('exams.status', 'Inactive');
                    })
                    ->orderBy('exams.exam_id', 'desc');

        return !empty($exams) ? $exams : null;
    }

    /**
     * Saving new exam
     */
    public static function storeExam($request)
    {
        DB::beginTransaction();

        try {

            /**
             * Saving new exam to exams table
             */
            $data = [
                'title'             => $request->title,
                'instruction'       => $request->instruction,
                'class_id'          => $request->class_id,
                'assessor_id'       => 1, //temporary
                'length'            => $request->points,
                'allowed_attempts'  => $request->allowed_attempts,
                'start'             => (!empty($request->start) ? date('Y-m-d H:i:s', strtotime($request->start)) : null),
                'end'               => (!empty($request->end) ? date('Y-m-d H:i:s', strtotime($request->end)) : null),
                'created_by'        => 1,
                'dt_created'        => date('Y-m-d H:i:s'),
                'status'            => 'Active',
            ];

            $save = self::insert($data);
            $exam_id = DB::getPdo()->lastInsertId();

            DB::commit();

            return [
                'success' => true,
                'exam_id' => $exam_id
            ];

        } catch (\Exception $e) {
            return ['success' => $e->getMessage()];
        }

    }

    /**
     * Getting all archives exams
     */
    public static function getArchives()
    {
        $exams = self::select(
                        'exams.*',
                        'classes.code as class_code',
                        'classes.name as class_name',
                    )
                    ->leftJoin('classes', 'exams.class_id', '=', 'classes.class_id')
                    ->where('exams.status', 'Inactive')
                    ->get();

        return !empty($exams) ? $exams : null;
    }
}
