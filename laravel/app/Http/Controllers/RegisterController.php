<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccessRole;
use App\Models\User;

class RegisterController extends Controller
{
    public function index()
    {
        $roles = AccessRole::all();

        return view('register', ['roles' => $roles]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fname' => 'required|string|max:50',
            'lname' => 'required|string|max:50',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|max:255|min:8|regex:/^.*(?=.{4,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!@#$%^&*]).*$/',
            'password_confirm' => 'required|same:password',
            'dob' => 'required|string|max:255',
            'role_id' => 'required|exists:access_roles,role_id',
        ],
        [
            'role_id.exists' => "Role does not exist",
            'password.regex' => 'Password must be at contain at least 8 characters, 1 capital letter, one lowercase letter, one number, and 1 special character (!$#%^&*)'
        ]);

        User::create($validated);

        return redirect()->route('home.index');
    }
}
