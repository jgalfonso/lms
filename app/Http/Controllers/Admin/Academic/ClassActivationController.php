<?php

namespace App\Http\Controllers\Admin\Academic;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Admin\Classes;

class ClassActivationController extends Controller
{
    /**
     * Display recent assignment/s
     */
    public function index ()
    {
        $classes = Classes::getClasses();

        return view('admin.academic.class-activation.index', compact('classes'));
    }
}
