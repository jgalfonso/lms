<?php

namespace App\Http\Controllers\Admin\Academic;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Admin\Assignments;
use App\Models\Admin\AssignmentAttachments;
use App\Models\Admin\Classes;
use App\Models\Admin\Courses;

class AssignmentsController extends Controller
{

    /**
     * Create new assignment
     */
    public function new ()
    {
        $courses = Courses::getCourses();

        return view('admin.academic.assignments.new', compact('courses'));
    }

    /**
     * Display recent assignment/s
     */
    public function recent ()
    {
        $assignments = Assignments::getAssignments();
        $classes = Classes::getClasses();

        return view('admin.academic.assignments.recent', compact('assignments', 'classes'));
    }

    /**
     * Display assignment archives
     */
    public function archives ()
    {
        $archives = Assignments::getArchives();
        $classes = Classes::getClasses();

        return view('admin.academic.assignments.archives', compact('archives', 'classes'));
    }

    /**
     * Saving new assignments
     */
    public function store (Request $request)
    {
        $new = Assignments::storeAssignment($request);

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
     * Display lessons filtered by class id
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function filter(Request $request)
    {
        $lessons = Assignments::filter($request)->get();

        echo json_encode($lessons);
    }

    /**
     * Display specific assignment/s
     */
    public function view (Request $request, $id)
    {
        $assignment  = Assignments::getById($id);
        $attachments = AssignmentAttachments::getAttachments($id);

        return view('admin.academic.assignments.view', compact('assignment', 'attachments'));
    }
}
