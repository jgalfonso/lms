<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Students;

class StudentsController extends Controller
{
    public function getByID(Request $request)
    {   
        $studentID = Auth::user()->student->student_id;
        $data = Students::getByID($studentID);
        
        echo json_encode($data);
    }
}
