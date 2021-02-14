<?php

namespace App\Http\Controllers\Admin\Services;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

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
}
