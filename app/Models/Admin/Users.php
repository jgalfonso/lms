<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Models\Admin\Avatar;
use App\Models\Admin\Credentials;
use App\Models\Admin\EducationBackground;
use App\Models\Admin\EmploymentHistory;
use App\Models\Admin\Profiles;

class Users extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'user_id';

    public static function add($request)
    {      
        DB::beginTransaction();

        try {

            $data = [
                'username'      => $request->email,
                'password'      => Hash::make($request->password),
                'user_type_id'  => $request->userTypeID,
                'dt_created'    => date('Y-m-d H:i:s'),
                'status'        => 'Active'
            ];

            $id = self::insertGetId($data);

            $request->request->add(['userID' => $id]);
            $profileID = Profiles::add($request);

            $request->request->add(['profileID' => $profileID]);
            if ($request->eb_name) EducationBackground::add($request);
            if ($request->eh_name) EmploymentHistory::add($request);
            if ($request->c_name) Credentials::add($request);
            if ($request->hasFile('file')) Avatar::add($request);

            DB::commit();

            return ['success' => true];

        } catch (\Exception $e) {
            
            DB::rollback();
            return $e->getMessage();
        }
    }
}



