<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function registerPage()
    {
        $access_roles = DB::table('access_roles')->get();
        return view('register', $access_roles);
    }
}
