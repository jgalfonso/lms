<?php

namespace App\Http\Controllers\Admin\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Admin\Classes;
use App\Models\Admin\Courses;
use App\Models\Admin\Profiles;
use App\Models\Admin\ScheduleTypes;

class ClassController extends Controller
{
    public function index ()
    {
        $courses = Courses::getCourses();
        $classes = Classes::getClasses();

        return view('admin.setup.classes.index', compact('courses', 'classes'));
    }

    public function activate(Request $request)
    {
        dd($request);
        $request->request->add(['userID' => Auth::id()]);
        $data = Classes::activate($request);

        echo json_encode($data);
    }

    public function close(Request $request)
    {
        $request->request->add(['userID' => Auth::id()]);
        $data = Classes::close($request);

        echo json_encode($data);
    }

    public function new ()
    {
        $courses = Courses::getCourses();
        $faculty = Profiles::getByUserTypeID(2);
        $schedule_types = ScheduleTypes::getScheduleTypes();

        return view('admin.setup.classes.new', compact('courses', 'faculty', 'schedule_types'));
    }

    public function store(Request $request)
    {
        $request->request->add(['classTypeID' => 1, 'userID' => Auth::id()]);
        $data = Classes::add($request);

        echo json_encode($data);
    }

    public function view($id)
    {
        $class = Classes::getByID($id);

        return view('admin.setup.classes.view', compact('class'));
    }

    public function edit($id)
    {
        $class = Classes::getByID($id);
        $courses = Courses::getCourses();
        $faculty = Profiles::getByUserTypeID(2);
        $schedule_types = ScheduleTypes::getScheduleTypes();

        return view('admin.setup.classes.edit', compact('class', 'courses', 'faculty', 'schedule_types'));
    }

    public function update(Request $request)
    {
        $request->request->add(['classTypeID' => 1, 'userID' => Auth::id()]);
        $data = Classes::edit($request);

        echo json_encode($data);
    }
}
