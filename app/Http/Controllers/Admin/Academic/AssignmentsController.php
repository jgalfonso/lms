<?php

namespace App\Http\Controllers\Admin\Academic;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Admin\Assignments;
use App\Models\Admin\AssignmentAttachments;
use App\Models\Admin\AssignmentParticipants;
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
        $classes = Classes::getClasses();

        return view('admin.academic.assignments.new', compact('courses', 'classes'));
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
     * Display assignment/s to be avaluated
     */
    public function evaluation ()
    {
        $participants = AssignmentParticipants::getParticipants();
        $classes      = Classes::getClasses();
        $courses      = Courses::getCourses();

        return view('admin.academic.assignments.evaluation', compact(
            'participants',
            'classes',
            'courses'
        ));
    }

    /**
     * Display submitted assignment / attachment
     */
    public function submittedAttachments (Request $request, $id)
    {
        $participant  = AssignmentParticipants::getByID($id);
        $attachments  = AssignmentAttachments::getAttachments($participant->assignment_id);

        return view('admin.academic.assignments.submitted-attachments', compact(
            'participant',
            'attachments'
        ));
    }

    /**
     * Display assignment archives
     */
    public function archives ()
    {
        $assignments = Assignments::getArchives();
        $classes = Classes::getClasses();

        return view('admin.academic.assignments.archives', compact('assignments', 'classes'));
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
     * Getting instructos based on specific class_id
     */
    public function getInstructors (Request $request)
    {
        $instructors = Classes::getByID($request->class_id);

        echo json_encode($instructors);
    }

    /**
     * Display assignments filtered by class id
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

    /**
     * Edit assignment
     */
    public function edit (Request $request, $id)
    {
        $assignment  = Assignments::getById($id);
        $attachments = AssignmentAttachments::getAttachments($id);

        return view('admin.academic.assignments.edit', compact('assignment', 'attachments'));
    }

    /**
     * Mark as Active
     */
    public function activate(Request $request)
    {
        $request->request->add(['userID' => Auth::id()]);
        $data = Assignments::activate($request);

        echo json_encode($data);
    }

    /**
     * Mark as Closed
     */
    public function close(Request $request)
    {
        $request->request->add(['userID' => Auth::id()]);
        $data = Assignments::close($request);

        echo json_encode($data);
    }

    /**
     * Mark as Complete
     */
    public function complete(Request $request)
    {
        $request->request->add(['userID' => Auth::id()]);
        $data = AssignmentParticipants::complete($request);

        echo json_encode($data);
    }

    /**
     * Display submitted assignments filtered by class id
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function filterSubmitted(Request $request)
    {
        $participants = AssignmentParticipants::filter($request)->get();

        echo json_encode($participants);
    }
}
