<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class AuthController extends Controller
{
    public function in(Request $request)
    {
        $data = User::signInByRequest($request);
        
        echo json_encode($data);
    }

    public function out()
    {
        $data = User::signOut();
        
        echo json_encode($data);
    }
}
