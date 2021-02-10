<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use File;
use Storage;

class SubmittedAssignment extends Model
{
    protected $table = 'submitted_assignments';
    protected $primaryKey = 'submitted_id';

    public static function getByAssignmentID($request)
    {      
        $submitted = self::where('assignment_id', $request->assignmentID)
            ->get();

        return $submitted;
    }

    public static function add($request)
    {
        try {

        	foreach ($request->file('files') as $file) {

        		$filename = $file->getClientOriginalName();
                $file->move(public_path().'/files/', $filename); 

        		$data = [
	                'class_id'     	 	=> $request->classID,
	                'class_code'    	=> $request->classCode,
	                'assignment_id'    	=> $request->assignmentID,
	                'assignment_code'  	=> $request->assignmentCode,
	                'student_id'    	=> $request->studentID,
	                'student_no'    	=> $request->studentNO,
	                'submitted_file'    => $filename,
	                'date_submitted'	=> date('Y-m-d H:i:s')
	            ];

            	self::insert($data);
                /*
                $contents = collect(Storage::cloud()->listContents('/', true));

                $dir = $contents->where('type', '=', 'dir')
                    ->where('path', '=', '1uOYKSsQir3yU9vP8u4Eas1ACDvzlQOv7')
                    ->first(); 

                if ( ! $dir) {
                     return ['success' => false];
                }
                */

                $path = env('GOOGLE_DRIVE_FOLDER_ID').'/'.$request->classFolderID.'/'.$request->assignmentFolderID.'/';
            	
                $filePath = public_path().'/files/'.$filename;
                $fileData =  File::get($filePath);
                Storage::cloud()->put($path.$filename, $fileData);

                unlink(public_path().'/files/'.$filename);
            }
			
            return ['success' => true];

        } catch (Exception $e) {

            return $e->getMessage();
        }
    }
}



