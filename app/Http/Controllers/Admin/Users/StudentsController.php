<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Admin\Profiles;
use App\Models\Admin\Users;

class StudentsController extends Controller
{

    public function index()
    {
        $students = Profiles::getByUserTypeID(1);

        return view('admin.users.students.index', compact('students'));
    }

    public function getByUserTypeID(Request $request)
    {   
        $students = Profiles::getByUserTypeID($request->userTypeID);

        return response()->json($students);
    }

    public function new()
    {
        return view('admin.users.students.new');
    }

    public function store(Request $request) 
    {   
        $request->request->add(['password' => '12345678', 'userTypeID' => 1, 'createdBy' => Auth::id()]);
        $data = Users::add($request);

        echo json_encode($data);
    }
}
