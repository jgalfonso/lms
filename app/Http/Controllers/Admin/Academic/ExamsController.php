<?php

namespace App\Http\Controllers\Admin\Academic;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Admin\Classes;
use App\Models\Admin\Courses;
use App\Models\Admin\Exams;

class ExamsController extends Controller
{
    /**
     * Create new exam
     */
    public function new ()
    {
        $courses = Courses::getCourses();

        return view('admin.academic.exams.new', compact('courses'));
    }

    /**
     * Saving new lesson
     */
    public function store (Request $request)
    {
        $new = Exams::storeExam($request);

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
     * Display recent exams
     */
    public function recent ()
    {
        $exams   = Exams::getExams();
        $classes = Classes::getClasses();

        return view('admin.academic.exams.recent', compact('exams', 'classes'));
    }

    /**
     * Display exams filtered by class id
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function filter(Request $request)
    {
        $lessons = Exams::filter($request)->get();

        echo json_encode($lessons);
    }

    /**
     * Display exam archives
     */
    public function archives ()
    {
        $exams   = Exams::getArchives();
        $classes = Classes::getClasses();

        return view('admin.academic.exams.archives', compact('exams', 'classes'));
    }

    /**
     * Display specific exam
     */
    public function view ($id)
    {
        $exam = Exams::getById($id);

        return view('admin.academic.exams.view', compact('exam'));
    }
}
