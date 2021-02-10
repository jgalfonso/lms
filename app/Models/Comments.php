<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Comments extends Model
{
    protected $table = 'comments';
    protected $primaryKey = 'comment_id';

    public $timestamps = false;
    
    public static function getByReferenceID($request)
    {      
		$comments = self::select('comments.*', DB::raw('CONCAT(LEFT(student_master.first_name, 1), LEFT(student_master.last_name, 1)) student_initial'), 'student_attachment.attachment_path as student_path', 'student_attachment.attachment_filename as student_filename', DB::raw('CONCAT(LEFT(teacher_master.first_name, 1), LEFT(teacher_master.last_name, 1)) teacher_initial'), 'teacher_attachment.attachment_path as teacher_path', 'teacher_attachment.attachment_filename as teacher_filename')
            ->leftJoin('student_master', 'student_master.student_id', 'comments.author_id')
            ->leftJoin('student_attachment', 'student_attachment.student_id', 'comments.author_id')
            ->leftJoin('teacher_master', 'teacher_master.teacher_id', 'comments.author_id')
            ->leftJoin('teacher_attachment', 'teacher_attachment.teacher_id', 'comments.author_id')
            ->where([
            	['comments.commentable_type_id', $request->commentableTypeID],
                ['comments.reference_id', $request->referenceID],
                ['comments.status', 'Active']
            ])
            ->orderBy(DB::raw('CASE WHEN parent_id THEN parent_id ELSE comment_id END'))
            ->orderBy('comments.comment_id')
            ->get();

        return $comments;
    }

    public static function add($request)
    {      

    	DB::beginTransaction();

    	try {
    		$data = [
    			'commentable_type_id' 	=> $request->commentableTypeID,
               	'reference_id' 			=> $request->referenceID,
                'parent_id' 			=> $request->parentID,                
                'message' 				=> $request->message,
                'author_id' 			=> $request->authorID,
                'created_by' 			=> $request->userID,
                'dt_created' 			=> date('Y-m-d H:i:s'),
                'status' 				=> 'Active'
            ];

            self::insert($data);

            DB::table('announcements')->where('announcement_id', $request->referenceID)
                ->increment('comments', 1, [
                    'lupd_by' => $request->userID, 
                    'dt_lupd' => date('Y-m-d H:i:s')
                ]);

            DB::commit();

            return ['success' => true];
            
    	} 
    	catch (Exception $e) {

    		DB::rollback();

            return $e->getMessage();
        }  
    }

     public static function del($request)
    {      

        DB::beginTransaction();

        try {
            $data = [
                'lupd_by'   => $request->userID,
                'dt_lupd'   => date('Y-m-d H:i:s'),
                'status'    => 'Deleted'
            ];

            self::where('comment_id',  $request->commentID)->update($data);

            DB::table('announcements')->where('announcement_id', $request->referenceID)
                ->decrement('comments', 1, [
                    'lupd_by' => $request->userID, 
                    'dt_lupd' => date('Y-m-d H:i:s')
                ]);

            DB::commit();

            return ['success' => true];
            
        } 
        catch (Exception $e) {

            DB::rollback();

            return $e->getMessage();
        }  
    }
}



