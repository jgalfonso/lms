<?php

namespace App\Http\Controllers\Admin\Services;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Admin\Admissions;
use App\Models\Admin\Assessments;
use App\Models\Admin\AssessmentDetails;
use App\Models\Admin\Classes;

class AssessmentController extends Controller
{
    /**
     * Create new assessment
     */
    public function new ()
    {
        $classes = Classes::getClasses();

        return view('admin.services.assessment.new', compact('classes'));
    }

    /**
     * Display recent assessments
     */
    public function recent ()
    {
        $classes = Classes::getClasses();

        return view('admin.services.assessment.recent', compact('classes'));

    }

    /**
     * Get all trainees and class data by class
     */
    public function getTrainees(Request $request)
    {
        $trainees   = Admissions::getByClass($request);
        $class_data = Classes::getByID($request->class_id);

        $data = [
            'trainees'      => $trainees,
            'class_data'    => $class_data,
            'no_trainees'   => count($trainees)
        ];

        echo json_encode($data);
    }

    /**
     * Store new assessment
     */
    public function store(Request $request)
    {
        $data   = Assessments::add($request);

        echo json_encode($data);
    }

    /**
     * View new assessment
     */
    public function view ($id)
    {
        $assessment = Assessments::getAssessment($id);
        $trainees   = AssessmentDetails::getTrainees($id);

        return view('admin.services.assessment.view', compact('assessment', 'trainees'));
    }
}
