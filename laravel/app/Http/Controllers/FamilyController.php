<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FamilyController extends Controller
{
    public function home()
    {
        return view('family_home');
    }
}
