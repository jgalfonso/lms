<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EducationBackground extends Model
{
    protected $table = 'education_background';
    protected $primaryKey = 'system_id';

    public static function getByID($profileID)
    {      
        $education_background = self::where('profile_id', $profileID)->get();

        return $education_background;
    }

    public static function add($request)
    {   

        foreach ($request->eb_name as $key => $value) {
            $data = [
                'profile_id'    => $request->profileID,
                'name'          => $request->eb_name[$key],
                'address'       => $request->eb_address[$key],
                'course'        => $request->eb_course[$key],
                'from'          => $request->eb_from[$key],
                'to'            => $request->eb_to[$key],
                'created_by'    => $request->createdBy,
                'dt_created'    => date('Y-m-d H:i:s'),
                'status'        => 'Active'
            ];

            self::insert($data);
        }
    }

}