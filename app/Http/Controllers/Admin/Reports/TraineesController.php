<?php

namespace App\Http\Controllers\Admin\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Admin\Courses;
use App\Models\Admin\Profiles;

class TraineesController extends Controller
{
    public function index ()
    {
        $courses  = Courses::getCourses();
        $profiles = Profiles::getByCourseID();

        return view('admin.reports.trainees.index', compact('courses', 'profiles'));
    }

    /**
     * Display trainees filtered by course_id
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function filter(Request $request)
    {
        $profiles = Profiles::filterByCourse($request)->get();

        echo json_encode($profiles);
    }
}
