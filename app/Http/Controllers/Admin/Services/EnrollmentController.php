<?php

namespace App\Http\Controllers\Admin\Services;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Admin\Admissions;
use App\Models\Admin\Classes;
use App\Models\Admin\Courses;
use App\Models\Admin\Profiles;

class EnrollmentController extends Controller
{
    public function index ()
    {
        return view('admin.services.enrollment.index');
    }

    public function search(Request $request)
    {
        $data = Profiles::getByKey($request);

        echo json_encode($data);
    }

    public function new ($id)
    {
        $profile = Profiles::getByID($id);
        $classes = Classes::getByCourseID($profile->course_id);

        return view('admin.services.enrollment.new', compact('profile', 'classes'));
    }

    public function store(Request $request)
    {
        $request->request->add(['userID' => Auth::id()]);
        $data = Admissions::add($request);

        echo json_encode($data);
    }

    public function classSummary(Request $request)
    {
        $data    = Admissions::getAdmission();
        $courses = Courses::getCourses();

        return view('admin.services.enrollment.class-summary', compact('data', 'courses'));
    }

    public function filterClassSummary(Request $request)
    {
        $data = Admissions::getByCourse($request);

        echo json_encode($data);
    }
}
