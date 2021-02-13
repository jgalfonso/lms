<?php

namespace App\Http\Controllers\Admin\Academic;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ExamsController extends Controller
{
    /**
     * Create new exam
     */
    public function new ()
    {
        return view('admin.academic.exams.new');
    }

    /**
     * Display recent exams
     */
    public function recent ()
    {
        return view('admin.academic.exams.recent');
    }

    /**
     * Display exam archives
     */
    public function archives ()
    {
        return view('admin.academic.exams.archives');
    }
}
