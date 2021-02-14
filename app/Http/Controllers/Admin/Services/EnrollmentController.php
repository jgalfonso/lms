<?php

namespace App\Http\Controllers\Admin\Services;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Admin\Classes;

class EnrollmentController extends Controller
{
    /**
     * Create new enrollment
     */
    public function new ()
    {
        $classes = Classes::getClasses();

        return view('admin.services.enrollment.new', compact('classes'));
    }

    /**
     * Display recent enrollments
     */
    public function search ()
    {
        $classes = Classes::getClasses();

        return view('admin.services.enrollment.search', compact('classes'));

    }

    /**
     * Display class summary
     */
    public function classSummary ()
    {
        $classes = Classes::getClasses();

        return view('admin.services.enrollment.class-summary', compact('classes'));

    }
}
