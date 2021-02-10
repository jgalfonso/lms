<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Comments;

class CommentsController extends Controller
{	

	public function getByReferenceID(Request $request)
    {   
       $data = Comments::getByReferenceID($request);

        return response()->json($data);
    }

    public function store(Request $request)
    {   
        $request->request->add(['authorID' => Auth::user()->student->student_id]);
        $request->request->add(['userID' => Auth::user()->user_id]);
        $data = Comments::add($request);

        return response()->json($data); 
    }

     public function delete(Request $request)
    {   
        $request->request->add(['userID' => Auth::user()->user_id]);
        $data = Comments::del($request);

        return response()->json($data); 
    }
}
