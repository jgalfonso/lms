<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Admin\Profiles;
use App\Models\Admin\Users;

class FacultyController extends Controller
{

    public function index()
    {
        $faculty = Profiles::getByUserTypeID(2);

        return view('admin.users.faculty.index', compact('faculty'));
    }

    public function getByUserTypeID(Request $request)
    {   
        $faculty = Profiles::getByUserTypeID($request->userTypeID);

        return response()->json($faculty);
    }

    public function new()
    {
        return view('admin.users.faculty.new');
    }

    public function store(Request $request) 
    {   
        $request->request->add(['password' => '12345678', 'userTypeID' => 2, 'createdBy' => Auth::id()]);
        $data = Users::add($request);

        echo json_encode($data);
    }
}
