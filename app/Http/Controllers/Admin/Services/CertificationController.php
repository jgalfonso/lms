<?php

namespace App\Http\Controllers\Admin\Services;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Admin\Classes;

class CertificationController extends Controller
{
    /**
     * Display moderations of certificates
     */
    public function moderations ()
    {
        return view('admin.services.certification.moderations');
    }

    /**
     * Process of moderation of certificates
     */
    public function process ()
    {
        return view('admin.services.certification.process');
    }

    /**
     * Display published certificates
     */
    public function published ()
    {
        return view('admin.services.certification.published');
    }

    /**
     * Display view of certificate
     */
    public function view ()
    {
        return view('admin.services.certification.view');
    }
}
