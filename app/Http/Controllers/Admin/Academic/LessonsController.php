<?php

namespace App\Http\Controllers\Admin\Academic;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Admin\Lessons;
use App\Models\Admin\Courses;
use App\Models\Admin\Classes;

class LessonsController extends Controller
{
    /**
     * Create new lesson
     */
    public function new ()
    {
        $courses = Courses::getCourses();

        return view('admin.academic.lessons.new', compact('courses'));
    }

    /**
     * Saving new lesson
     */
    public function store (Request $request)
    {
        $new = Lessons::storeLesson($request);

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

    /**
     * Display all lessons
     */
    public function lessonPlan ()
    {
        $lessons = Lessons::getLessons();
        $classes = Classes::getClasses();

        return view('admin.academic.lessons.lesson-plan', compact('lessons', 'classes'));

    }

    /**
     * Display lessons filtered by class id
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function filter(Request $request)
    {
        $lessons = Lessons::filter($request)->get();

        echo json_encode($lessons);
    }
}
