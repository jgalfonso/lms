<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Enrollments;
use App\Models\Announcements;
use App\Models\Comments;

class AnnouncementsController extends Controller
{	

	public function getAnnouncementByID(Request $request)
    {   
        $data['announcement'] = Announcements::getByID($request);
        
        $request->request->add(['commentableTypeID' => 1, 'referenceID' => $request->announcementID]);
        $data['comments'] = Comments::getByReferenceID($request);

        return response()->json($data);
    }

}
