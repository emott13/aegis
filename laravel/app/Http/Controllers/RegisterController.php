<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccessRole;

class RegisterController extends Controller
{
    public function registerPage()
    {
        $roles = AccessRole::all();

        return view('register', ['roles' => $roles]);
    }
}
