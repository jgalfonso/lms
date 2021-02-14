<?php

namespace App\Http\Controllers\Admin\Academic;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Admin\Projects;
use App\Models\Admin\Classes;
use App\Models\Admin\Courses;

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
        $new = Projects::storeProject($request);

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
     * Display projects filtered by class id
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function filter(Request $request)
    {
        $projects = Projects::filter($request)->get();

        echo json_encode($projects);
    }
}
