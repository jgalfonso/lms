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

    public function view($id)
    {
        $student = Profiles::getByID($id);
        $education_background = EducationBackground::getByID($id);
        $employment_history = EmploymentHistory::getByID($id);
        $credentials = Credentials::getByID($id);

        return view('admin.users.students.view', compact('student', 'education_background', 'employment_history', 'credentials'));
    }

    public function edit($id)
    {
        $student = Profiles::getByID($id);
        $education_background = EducationBackground::getByID($id);
        $employment_history = EmploymentHistory::getByID($id);
        $credentials = Credentials::getByID($id);

        return view('admin.users.students.edit', compact('student', 'education_background', 'employment_history', 'credentials'));
    }

    public function update(Request $request) 
    {   
        $request->request->add(['updatedBy' => Auth::id()]);
        $data = Profiles::edit($request);

        echo json_encode($data);
    }
}
