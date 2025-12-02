<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function loginPage()
    {
        return view('login');
    }

    public function login()
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string|max:255',
        ])
    }
}
