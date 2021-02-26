<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Credentials extends Model
{
    protected $table = 'credentials';
    protected $primaryKey = 'system_id';

    public static function getByID($profileID)
    {      
        $credentials = self::where('profile_id', $profileID)->get();

        return $credentials;
    }

    public static function add($request)
    {   

        foreach ($request->c_name as $key => $value) {
            $data = [
                'profile_id'    => $request->profileID,
                'name'          => $request->c_name[$key],
                'address'       => $request->c_address[$key],
                'title'         => $request->c_title[$key],
                'reference_no'  => $request->c_control_no[$key],
                'date_issued'   => $request->c_date_month[$key].' '.$request->c_date_year[$key],
                'created_by'    => $request->createdBy,
                'dt_created'    => date('Y-m-d H:i:s'),
                'status'        => 'Active'
            ];

            self::insert($data);
        }
    }

}