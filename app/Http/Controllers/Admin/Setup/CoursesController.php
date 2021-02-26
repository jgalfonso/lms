<?php

namespace App\Http\Controllers\Admin\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Admin\Courses;

class CoursesController extends Controller
{
    public function index ()
    {
        $courses = Courses::getCourses();

        return view('admin.setup.courses.index', compact('courses'));
    }

    public function new ()
    {
        return view('admin.setup.courses.new');
    }

    public function store(Request $request) 
    {   
        $request->request->add(['classTypeID' => 1, 'userID' => Auth::id()]);
        $data = Courses::add($request);

        echo json_encode($data);
    }

    public function view($id)
    {
        $course = Courses::getByID($id);

        return view('admin.setup.courses.view', compact('course'));
    }

    public function edit($id)
    {
        $course = Courses::getByID($id);

        return view('admin.setup.courses.edit', compact('course'));
    }

    public function update(Request $request) 
    {   
        $request->request->add(['classTypeID' => 1, 'userID' => Auth::id()]);
        $data = Courses::edit($request);

        echo json_encode($data);
    }
}
