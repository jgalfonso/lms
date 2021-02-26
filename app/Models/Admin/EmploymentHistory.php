<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EmploymentHistory extends Model
{
    protected $table = 'employment_history';
    protected $primaryKey = 'system_id';

    public static function getByID($profileID)
    {      
        $employment_history = self::where('profile_id', $profileID)->get();

        return $employment_history;
    }

    public static function add($request)
    {   

        foreach ($request->eh_name as $key => $value) {
            $data = [
                'profile_id'    => $request->profileID,
                'name'          => $request->eh_name[$key],
                'address'       => $request->eh_address[$key],
                'position'      => $request->eh_position[$key],
                'contact'       => $request->eh_contact[$key],
                'from'          => $request->eh_from_month[$key].' '.$request->eh_from_year[$key],
                'to'            => $request->eh_to_month[$key].' '.$request->eh_to_year[$key],
                'created_by'    => $request->createdBy,
                'dt_created'    => date('Y-m-d H:i:s'),
                'status'        => 'Active'
            ];

            self::insert($data);
        }
    }

}