<?php

namespace App\Http\Controllers\Admin\Academic;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Admin\Classes;
use App\Models\Admin\Courses;
use App\Models\Admin\Projects;
use App\Models\Admin\ProjectAttachments;
use App\Models\Admin\ProjectParticipants;

class ProjectsController extends Controller
{
    /**
     * Create new project
     */
    public function new ()
    {
        $courses = Courses::getCourses();

        return view('admin.academic.projects.new', compact('courses'));
    }

    /**
     * Display recent project/s
     */
    public function recent ()
    {
        $projects = Projects::getProjects();
        $classes  = Classes::getClasses();

        return view('admin.academic.projects.recent', compact(
            'projects',
            'classes'
        ));
    }

    /**
     * Display project archives
     */
    public function archives ()
    {
        $archives = Projects::getArchives();
        $classes  = Classes::getClasses();

        return view('admin.academic.projects.archives', compact(
            'archives',
            'classes'
        ));
    }

    /**
     * Saving new project
     */
    public function store (Request $request)
    {
        $request->request->add(['userID' => Auth::id()]);
        $new = Projects::storeProject($request);

        echo json_encode($new);
    }

    /**
     * Getting classes using specific course_id
     */
    public function getClasses (Request $request)
    {
        $classes = Classes::getByCourseID($request->course_id);

        echo json_encode($classes);
    }

    /**
     * Display projects filtered by class id
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function filter(Request $request)
    {
        $projects = Projects::filter($request)->get();

        echo json_encode($projects);
    }

    /**
     * Display specific project
     */
    public function view ($id)
    {
        $project      = Projects::getById($id);
        $attachments  = ProjectAttachments::getAttachments($id);

        return view('admin.academic.projects.view', compact('project', 'attachments'));
    }

    /**
     * Edit project
     */
    public function edit ($id)
    {
        $project      = Projects::getById($id);
        $attachments  = ProjectAttachments::getAttachments($id);

        return view('admin.academic.projects.edit', compact('project', 'attachments'));
    }

    /**
     * Getting instructor using class id
     */
    public function getInstructor (Request $request)
    {
        $classes = Classes::getByID($request->class_id);

        echo json_encode($classes);
    }

    /**
     * Mark projects active
     */
    public function activate(Request $request)
    {
        $request->request->add(['userID' => Auth::id()]);
        $data = Projects::activate($request);

        echo json_encode($data);
    }

    /**
     * Mark projects close
     */
    public function close(Request $request)
    {
        $request->request->add(['userID' => Auth::id()]);
        $data = Projects::close($request);

        echo json_encode($data);
    }

    /**
     * Display projects/s to be avaluated
     */
    public function evaluation ()
    {
        $participants = ProjectParticipants::getParticipants();
        $classes      = Classes::getClasses();
        $courses      = Courses::getCourses();

        return view('admin.academic.projects.evaluation', compact(
            'participants',
            'classes',
            'courses'
        ));
    }

    /**
     * Display submitted projects / attachment
     */
    public function submittedAttachments (Request $request, $id)
    {
        $participant  = ProjectParticipants::getByID($id);
        $attachments  = ProjectAttachments::getAttachments($participant->project_id);

        return view('admin.academic.projects.submitted-attachments', compact(
            'participant',
            'attachments'
        ));
    }

    /**
     * Display project participants filtered by class id and keyword
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function filterSubmitted(Request $request)
    {
        $participants = ProjectParticipants::filter($request)->get();

        echo json_encode($participants);
    }

    /**
     * Mark project participant as completed
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function complete(Request $request)
    {
        $request->request->add(['userID' => Auth::id()]);
        $complete = ProjectParticipants::complete($request);

        echo json_encode($complete);
    }
}
