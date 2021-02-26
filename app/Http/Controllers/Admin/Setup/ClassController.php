<?php

namespace App\Http\Controllers\Admin\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Admin\Classes;
use App\Models\Admin\Courses;
use App\Models\Admin\ScheduleTypes;

class ClassController extends Controller
{
    /**
     * Display list of classes
     */
    public function index ()
    {
        $classes = Classes::getClasses();
        $courses = Courses::getCourses();

        return view('admin.setup.class.index', compact(
            'classes',
            'courses'
        ));
    }

    /**
     * Create new class
     */
    public function new ()
    {
        $courses    = Courses::getCourses();
        $schedTypes = ScheduleTypes::getSchedTypes();

        return view('admin.setup.class.new', compact('courses', 'schedTypes'));
    }

    /**
     * Saving new class
     */
    public function store (Request $request)
    {
        $new = Classes::storeClass($request);

        echo json_encode($new);
    }

    /**
     * Getting classes using specific course_id
     */
    public function getClasses (Request $request)
    {
        $classes = Classes::getByCourse($request);

        echo json_encode($classes);
    }
}
