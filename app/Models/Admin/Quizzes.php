<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Quizzes extends Model
{
    protected $table = 'quizzes';
    protected $primaryKey = 'quiz_id';

    /**
     * Getting all quizzes
     */
    public static function getQuizzes()
    {
        $quizzes = self::select(
                        'quizzes.*',
                    )
                    ->where('quizzes.status', 'Active')
                    ->get();

        return !empty($quizzes) ? $quizzes : null;
    }

    /**
     * Getting specific quiz
     */
    public static function getById($id)
    {
        $quiz = self::select(
                        'quizzes.*',
                        'classes.code as class_code',
                        'classes.name as class_name',
                    )
                    ->leftJoin('classes', 'quizzes.class_id', '=', 'classes.class_id')
                    // ->where('quizzes.status', 'Active')
                    ->first();

        return !empty($quiz) ? $quiz : null;
    }

    /**
     * Get all quizzes
     * Filtered by class
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public static function filter ($request)
    {
        $class_id = $request->class_id;
        $archives = (isset($request->archives) && $request->archives == 1 ? 1 : null);

        $quizzes = self::select(
                        'quizzes.*',
                        'classes.code as class_code',
                        'classes.name as class_name',
                    )
                    ->leftJoin('classes', 'quizzes.class_id', '=', 'classes.class_id')
                    ->when($class_id, function ($query) use ($class_id) {
                        return $query->where('quizzes.class_id', $class_id);
                    })
                    ->when($archives, function ($query) use ($archives) {
                        return $query->where('quizzes.status', 'Inactive');
                    })
                    ->orderBy('quizzes.quiz_id', 'desc');

        return !empty($quizzes) ? $quizzes : null;
    }

    /**
     * Saving new quiz
     */
    public static function storeQuiz($request)
    {
        DB::beginTransaction();

        try {

            /**
             * Saving new quiz to quizzes table
             */
            $data = [
                'title'             => $request->title,
                'instruction'       => $request->instruction,
                'class_id'          => $request->class_id,
                'assessor_id'       => 1, // temporary,
                'length'            => $request->points,
                'allowed_attempts'  => $request->allowed_attempts,
                'start'             => (!empty($request->start) ? date('Y-m-d H:i:s', strtotime($request->start)) : null),
                'end'               => (!empty($request->end) ? date('Y-m-d H:i:s', strtotime($request->end)) : null),
                'created_by'        => 1,
                'dt_created'        => date('Y-m-d H:i:s'),
                'status'            => 'Active',
            ];

            $save = self::insert($data);
            $quiz_id = DB::getPdo()->lastInsertId();

            DB::commit();

            return [
                'success' => true,
                'quiz_id' => $quiz_id
            ];

        } catch (\Exception $e) {
            return ['success' => $e->getMessage()];
        }

    }

    /**
     * Getting all archive quizzes
     */
    public static function getArchives()
    {
        $archives = self::select(
                        'quizzes.*',
                        'classes.code as class_code',
                        'classes.name as class_name',
                    )
                    ->leftJoin('classes', 'quizzes.class_id', '=', 'classes.class_id')
                    ->where('quizzes.status', 'Inactive')
                    ->get();

        return !empty($archives) ? $archives : null;
    }
}
