<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AdmissionDetails extends Model
{
    protected $table = 'admission_details';
    protected $primaryKey = 'system_id';

    public static function getByClassID($request)
    {      
        $admissions = self::select('profiles.control_no', 'profiles.lastname', 'profiles.firstname', 'profiles.middlename')
            ->join('admissions', 'admissions.admission_id', 'admission_details.admission_id')
            ->join('profiles', 'profiles.profile_id', 'admissions.profile_id')
            ->where('admission_details.class_id', $request->classID)
            ->orderBy('profiles.lastname')
            ->orderBy('profiles.firstname')
            ->orderBy('profiles.middlename')
            ->get();

        return $admissions;
    }

    public static function add($request)
    {      
        try {

            $data = [
                'admission_id'  => $request->admissionID,
                'class_id'      => $request->classID,
                'dt_created'    => date('Y-m-d H:i:s')
            ];

            self::insert($data);

            return true;

        } catch (\Exception $e) {
            
            return $e->getMessage();
        }
    }
}
