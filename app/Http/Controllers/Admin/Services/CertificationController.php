<?php

namespace App\Http\Controllers\Admin\Services;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Admin\Assessments;
use App\Models\Admin\Certificates;
use App\Models\Admin\Moderations;

class CertificationController extends Controller
{
    public function moderations()
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

    public function getByStatus(Request $request)
    {
        $data = Certificates::getByStatus($request->status);

        echo json_encode($data);
    }
    
    public function moderate($id)
    {
        $today = date('d/m/Y');
        $certificate = Certificates::getByID($id);
        $assessment = Assessments::getByID($certificate->assessment_id);
        $moderations = Moderations::getModerations($id);

        return view('admin.services.certification.moderate', compact('today', 'certificate', 'assessment', 'moderations'));
    }

    public function store(Request $request) 
    {   
        $request->request->add(['userID' => Auth::id()]);
        $data = Moderations::add($request);

        echo json_encode($data);
    }

    public function view($id)
    {
        $certificate = Certificates::getByID($id);
        $moderations = Moderations::getModerations($certificate->assessment_id);

        return view('admin.services.certification.view', compact('certificate', 'moderations'));
    }

    public function published ()
    {
        $certificates = Certificates::getByStatus('Published');

        return view('admin.services.certification.published', compact('certificates'));
    }
}
