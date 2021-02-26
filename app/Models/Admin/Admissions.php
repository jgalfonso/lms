<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Admissions extends Model
{
    protected $table = 'admissions';
    protected $primaryKey = 'admission_id';
    public $timestamps = false;

    public static function add($request)
    {      
        DB::beginTransaction();

        try {

            $classes = json_decode($request->classIDS);

            foreach($classes as $class){
                
                $data = [
                    'profile_id'        => $request->profileID,
                    'course_id'         => $request->courseID,
                    'class_id'          => $class->classID,
                    'date_enrolled'     => date('Y-m-d H:i:s'),
                    'created_by'        => $request->userID,
                    'dt_created'        => date('Y-m-d H:i:s'),
                    'status'            => 'Active'
                ];

                $id = self::insertGetId($data);

                self::where('admission_id', $id )->update(['code' => sprintf('%010s', $id)]);
            }

            DB::commit();

            return ['success' => true];

        } catch (\Exception $e) {
            
            DB::rollback();
            return $e->getMessage();
        }
    }
}
