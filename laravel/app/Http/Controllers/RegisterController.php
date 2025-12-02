<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccessRole;
use App\Models\User;
use App\Models\Patient;
use App\Models\Employee;
use DB;

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

            // patient
            'emergency_fname' => 'max:50',
            'emergency_lname' => 'max:50',
            'emergency_phone' => 'max:10',
            'family_code' => 'max:20',
            'emergency_relation' => 'max:20',
        ],
        [
            'role_id.exists' => "Role does not exist",
            'password.regex' => 'Password must be at contain at least 8 characters, 1 capital letter, one lowercase letter, one number, and 1 special character (!$#%^&*)'
        ]);

        $user = User::create($validated);

        echo $user;
        if ($user)
        {
            $roleName = DB::table('access_roles')->where('role_id', $user['role_id'])->value('role_name');
            $accessLevel = DB::table('access_roles')->where('role_id', $user['role_id'])->value('access_level');
            $validated['user_id'] = $user['user_id'];
            if ($roleName == 'patient')
            {
                Patient::create($validated);
            }
            else if (intval($accessLevel) <= 5)
            {
                Employee::create($validated);
            }
        }

        return redirect()->route('home.index');
    }
}
