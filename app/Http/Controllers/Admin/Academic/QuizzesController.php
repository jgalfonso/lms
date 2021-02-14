<?php

namespace App\Http\Controllers\Admin\Academic;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class QuizzesController extends Controller
{
    /**
     * Create new quiz
     */
    public function new ()
    {
        return view('admin.academic.quizzes.new');
    }

    /**
     * Display recent quizzes
     */
    public function recent ()
    {
        return view('admin.academic.quizzes.recent');
    }

    /**
     * Display quiz archives
     */
    public function archives ()
    {
        return view('admin.academic.quizzes.archives');
    }
}
