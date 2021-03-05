<?php

namespace App\Http\Controllers\Admin\Services;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Admin\Certificates;
use App\Models\Admin\Moderations;

class CertificationController extends Controller
{
    public function moderations ()
    {

        $summary = Certificates::getSummary();
        $entries = Certificates::getEntries('New');

        return view('admin.services.certification.moderations', compact('summary', 'entries'));
    }

    public function getEntries(Request $request)
    {
        $data = Certificates::getEntries($request->status);

        echo json_encode($data);
    }
    
    public function moderate($id)
    {
        $today = date('d/m/Y');
        $entry = Certificates::getByID($id);
        $certifications = Certificates::getCertificatesByAssessmentID($id);
        $moderations = Moderations::getModerations($id);

        return view('admin.services.certification.moderate', compact('today', 'entry', 'certifications', 'moderations'));
    }

    public function store(Request $request) 
    {   
        $request->request->add(['userID' => Auth::id()]);
        $data = Moderations::add($request);

        echo json_encode($data);
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
