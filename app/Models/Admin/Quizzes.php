<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Quizzes extends Model
{
    protected $table = 'quizzes';
    protected $primaryKey = 'quiz_id';
    public $timestamps = false;

    /**
     * Getting all quizzes
     */
    public static function getQuizzes()
    {
        $quizzes = self::select(
                        'quizzes.*',
                        'classes.code as class_code',
                        'classes.name as class_name',
                    )
                    ->leftJoin('classes', 'quizzes.class_id', '=', 'classes.class_id')
                    ->where('quizzes.status', 'Active')
                    ->get();

        return !empty($quizzes) ? $quizzes : null;
    }

    /**
     * Getting specific quiz
     */
    public static function getById($quizID)
    {
        $quiz = self::select(
                        'quizzes.*',
                        'classes.code as class_code',
                        'classes.name as class_name',
                        'courses.course_id as course_id',
                        'courses.name as course_name'
                    )
                    ->leftJoin('classes', 'quizzes.class_id', '=', 'classes.class_id')
                    ->leftJoin('courses', 'classes.course_id', '=', 'courses.course_id')
                    ->where('quizzes.quiz_id', $quizID)
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
        $quiz_id = $request->class_id;
        $archives = (isset($request->archives) && $request->archives == 1 ? 1 : null);

        $quizzes = self::select(
                        'quizzes.*',
                        'classes.code as class_code',
                        'classes.name as class_name',
                    )
                    ->leftJoin('classes', 'quizzes.class_id', '=', 'classes.class_id')
                    ->when($quiz_id, function ($query) use ($quiz_id) {
                        return $query->where('quizzes.class_id', $quiz_id);
                    })
                    ->when($archives, function ($query) use ($archives) {
                        return $query->where('quizzes.status', 'Closed');
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
                    ->where('quizzes.status', 'Closed')
                    ->get();

        return !empty($archives) ? $archives : null;
    }

    /**
     * Activate quiz/quizzes
     */
    public static function activate($request)
    {
        try {

            $quizzes = json_decode($request->quizIDS);

            foreach($quizzes as $quiz){

                $data = [
                    'lupd_by'   => $request->userID,
                    'dt_lupd'   => date('Y-m-d H:i:s'),
                    'status'    => 'Active'
                ];

                self::where('quiz_id', $quiz->quizID)->update($data);
            }

            return ['success' => true];

        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }

    /**
     * Close quiz/quizzes
     */
    public static function close($request)
    {
        try {

            $quizzes = json_decode($request->quizIDS);

            foreach($quizzes as $quiz){

                $data = [
                    'lupd_by'   => $request->userID,
                    'dt_lupd'   => date('Y-m-d H:i:s'),
                    'status'    => 'Closed'
                ];

                self::where('quiz_id', $quiz->quizID)->update($data);
            }

            return ['success' => true];

        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }
}
