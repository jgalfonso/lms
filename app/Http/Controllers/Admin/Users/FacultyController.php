<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Admin\Credentials;
use App\Models\Admin\EducationBackground;
use App\Models\Admin\EmploymentHistory;
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

    public function view($id)
    {
        $faculty = Profiles::getByID($id);
        $education_background = EducationBackground::getByID($id);
        $employment_history = EmploymentHistory::getByID($id);
        $credentials = Credentials::getByID($id);

        return view('admin.users.faculty.view', compact('faculty', 'education_background', 'employment_history', 'credentials'));
    }

    public function edit($id)
    {
        $faculty = Profiles::getByID($id);
        $education_background = EducationBackground::getByID($id);
        $employment_history = EmploymentHistory::getByID($id);
        $credentials = Credentials::getByID($id);

        return view('admin.users.faculty.edit', compact('faculty', 'education_background', 'employment_history', 'credentials'));
    }

    public function update(Request $request) 
    {   
        $request->request->add(['updatedBy' => Auth::id()]);
        $data = Profiles::edit($request);

        echo json_encode($data);
    }
}
