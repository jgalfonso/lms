<?php

namespace App\Http\Controllers\Admin\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Admin\Classes;
use App\Models\Admin\Courses;

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
        $courses = Courses::getCourses();

        return view('admin.setup.class.new', compact('courses'));
    }
}
