<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Profiles extends Model
{
    protected $table = 'profiles';
    protected $primaryKey = 'profile_id';
    public $timestamps = false;
    
    public static function getByUserTypeID($userTypeID)
    {      
        $profiles = self::select('profiles.*', DB::raw('TIMESTAMPDIFF(YEAR, profiles.dob, CURDATE()) age'), 'avatar.meta','avatar.filename')
            ->join('users', function($join) use($userTypeID)
                {
                    $join->on('users.user_id', 'profiles.user_id');
                    $join->where('users.user_type_id', $userTypeID);
                })
            ->leftJoin('avatar', function($join) 
                {
                    $join->on('avatar.profile_id', 'profiles.profile_id');
                    $join->where('avatar.status', 'Active');
                })
            ->whereIn('profiles.status', ['New', 'Active'])
            ->orderBy(DB::raw('CONCAT(profiles.firstname, " ", profiles.lastname)'))
            ->get();

        return $profiles;
    }

    public static function getByID($profileID)
    {      
        $profile = self::select('profiles.*', DB::raw('TIMESTAMPDIFF(YEAR, profiles.dob, CURDATE()) age'), 'avatar.meta', 'avatar.filename')
            ->leftJoin('avatar', function($join) 
                {
                    $join->on('avatar.profile_id', 'profiles.profile_id');
                    $join->where('avatar.status', 'Active');
                })
            ->where('profiles.profile_id', $profileID)
            ->first();

        return $profile;
    }

    public static function getByKey($request)
    {      
        $profiles = self::select('profiles.*', DB::raw('TIMESTAMPDIFF(YEAR, profiles.dob, CURDATE()) age'), 'avatar.meta', 'avatar.filename')
            ->join('users', function($join) 
                {
                    $join->on('users.user_id', 'profiles.user_id');
                    $join->where('users.user_type_id', 1);
                })
            ->leftJoin('avatar', function($join) 
                {
                    $join->on('avatar.profile_id', 'profiles.profile_id');
                    $join->where('avatar.status', 'Active');
                })
            ->where('profiles.status', 'Active')
            ->where(function ($query) use($request) 
                {
                    $query->where(DB::raw('CONCAT(profiles.firstname, " ", profiles.middlename, " ", profiles.lastname)'), 'LIKE', $request->key.'%')
                          ->orWhere('profiles.control_no', 'LIKE', $request->key.'%');
                })
            ->get();

        return $profiles;
    }

    public static function add($request)
    {      
        $data = [
            'user_id'           => $request->userID,
            'control_no'        => sprintf('%010s', $request->userID),
            'registration_no'   => $request->registrationNo,
            'reference_no'      => $request->referenceNo,
            'lastname'          => $request->lastname,
            'firstname'         => $request->firstname,
            'middlename'        => $request->middlename,
            'suffix'            => $request->suffix,
            'dob'               => date('Y-m-d H:i:s', strtotime($request->dob)),
            'pob'               => $request->pob,
            'gender'            => $request->gender,
            'civil_status'      => $request->civilStatus,
            'height'            => $request->height,
            'weight'            => $request->weight,
            'eye_color'         => $request->eyeColor,
            'hair_color'        => $request->hairColor,
            'marks'             => $request->marks,
            'email'             => $request->email,
            'permanent_address' => $request->permanentAddress,
            'present_address'   => $request->presentAddress,
            'mobile_no1'        => $request->mobile1,
            'mobile_no2'        => $request->mobile2,
            'phone_no1'         => $request->phone1,
            'phone_no2'         => $request->phone2,
            'ec_name'           => $request->ecName,
            'ec_address'        => $request->ecAddress,
            'ec_contact_no'     => $request->ecContact,
            'fb'                => $request->fb,
            'linkedin'          => $request->linkedin,
            'created_by'        => $request->createdBy,
            'dt_created'        => date('Y-m-d H:i:s'),
            'status'            => 'Active'
        ];

        $id = self::insertGetId($data);

        return $id;
    }

    public static function edit($request)
    {      
        try {
            $data = [
                'registration_no'   => $request->registrationNo,
                'reference_no'      => $request->referenceNo,
                'lastname'          => $request->lastname,
                'firstname'         => $request->firstname,
                'middlename'        => $request->middlename,
                'suffix'            => $request->suffix,
                'dob'               => date('Y-m-d H:i:s', strtotime($request->dob)),
                'pob'               => $request->pob,
                'gender'            => $request->gender,
                'civil_status'      => $request->civilStatus,
                'height'            => $request->height,
                'weight'            => $request->weight,
                'eye_color'         => $request->eyeColor,
                'hair_color'        => $request->hairColor,
                'marks'             => $request->marks,
                'email'             => $request->email,
                'permanent_address' => $request->permanentAddress,
                'present_address'   => $request->presentAddress,
                'mobile_no1'        => $request->mobile1,
                'mobile_no2'        => $request->mobile2,
                'phone_no1'         => $request->phone1,
                'phone_no2'         => $request->phone2,
                'ec_name'           => $request->ecName,
                'ec_address'        => $request->ecAddress,
                'ec_contact_no'     => $request->ecContact,
                'fb'                => $request->fb,
                'linkedin'          => $request->linkedin,
                'lupd_by'           => $request->updatedBy,
                'dt_lupd'           => date('Y-m-d H:i:s'),
                'status'            => 'Active'
            ];

            self::where('profile_id', $request->profileID)->update($data);

            return ['success' => true, 'id' => $request->profileID];
        } catch (\Exception $e) {
            
            return $e->getMessage();
        }
    }
}



