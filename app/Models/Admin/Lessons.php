<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Lessons extends Model
{
    protected $table = 'lessons';
    protected $primaryKey = 'lesson_id';

    /**
     * Getting all lessons
     */
    public static function getLessons()
    {
        $lessons = self::select(
                        'lessons.*',
                        'classes.code as class_code',
                        'classes.name as class_name',
                    )
                    ->leftJoin('classes', 'lessons.class_id', '=', 'classes.class_id')
                    ->where('lessons.status', 'Active')
                    ->get();

        return !empty($lessons) ? $lessons : null;
    }

    /**
     * Get all lessons
     * Filtered by class
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public static function filter ($request)
    {
        $class_id = $request->class_id;

        $lessons = self::select(
                        'lessons.*',
                        'classes.code as class_code',
                        'classes.name as class_name',
                    )
                    ->leftJoin('classes', 'lessons.class_id', '=', 'classes.class_id')
                    ->when($class_id, function ($query) use ($class_id) {
                        return $query->where('lessons.class_id', $class_id);
                    })
                    ->orderBy('lessons.lesson_id', 'desc');

        return !empty($lessons) ? $lessons : null;
    }

    /**
     * Saving new lesson
     */
    public static function storeLesson($request)
    {
        DB::beginTransaction();

        try {

            /**
             * Saving new lesson to lessons table
             */
            $data = [
                'code'       => $request->code,
                'title'      => $request->title,
                'content'    => $request->content,
                'class_id'   => $request->class_id,
                'start'      => (!empty($request->start) ? date('Y-m-d H:i:s', strtotime($request->start)) : null),
                'end'        => (!empty($request->end) ? date('Y-m-d H:i:s', strtotime($request->end)) : null),
                'created_by' => 1,
                'dt_created' => date('Y-m-d H:i:s'),
                'status'     => 'Active',
            ];

            $save = self::insert($data);
            $lessonId = DB::getPdo()->lastInsertId();

            /**
             * Saving links of new lesson
             */
            if ($request->link_title) {
                foreach ($request->link_title as $key => $value) {
                    $data = [
                        'lesson_id'  => $lessonId,
                        'title'      => $request->link_title[$key],
                        'url'        => $request->link_url[$key],
                        'created_by' => 1,
                        'dt_created' => date('Y-m-d H:i:s'),
                    ];

                    $save = DB::table('lesson_links')->insert($data);
                }
            }

            /**
             * Saving attachment of new lesson
             */
            if ($request->hasFile('attach_file')) {

                foreach ($request->file('attach_file') as $key => $value) {

                    $path = public_path() .'/lessons/' . $request->course_id . '/' . $request->class_id . '/' . $lessonId . '/';

                    if (!file_exists($path)) {
                        mkdir($path,0777,TRUE);
                    }

                    $file       = $value;
                    $fileExt    = $file->getClientOriginalExtension();
                    $filename   = time().$file->getClientOriginalName();
                    $file->move($path, $filename);

                    $attach = [
                        'lesson_id'  => $lessonId,
                        'title'      => $request->attach_title[$key],
                        'filename'   => $filename,
                        'path'       => '/lessons/' . $request->course_id . '/' . $request->class_id . '/' . $lessonId . '/',
                        'created_by' => 1,
                        'dt_created' => date('Y-m-d H:i:s'),
                    ];

                    $save   = DB::table('lesson_attachments')->insert($attach);
                }
            }

            DB::commit();

            return ['success' => true];

        } catch (\Exception $e) {
            return ['success' => $e->getMessage()];
        }

    }

    /**
     * Getting all archive lessons
     */
    public static function getArchives()
    {
        $archives = self::select(
                        'lessons.*',
                        'classes.code as class_code',
                        'classes.name as class_name',
                    )
                    ->leftJoin('classes', 'lessons.class_id', '=', 'classes.class_id')
                    ->where('lessons.status', 'Inactive')
                    ->get();

        return !empty($archives) ? $archives : null;
    }
}
