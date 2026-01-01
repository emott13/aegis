<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccessRole;
use App\Models\User;
use App\Models\Patient;
use App\Models\Employee;
use Auth;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    // methods
    public function index()
    {
        $roles = AccessRole::all();                                 // created with factory

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
            // REQUIREMENT TO SEPERATE: try registration view?

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

        // $request->validate([
        //     'role_id' => ['required', 'exists:roles,role_id'],

        //     'emergency_fname' => [
        //         Rule::requiredIf(fn () => $request->role_id == $patientRoleId),
        //         'string',
        //         'nullable',
        //     ],

        //     'emergency_phone' => [
        //         Rule::requiredIf(fn () => $request->role_id == $patientRoleId),
        //         'nullable',
        //     ],
        // ]);


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

    public function approvalPage(Request $request)
    {
        $roleName = Auth::user()->getRoleName();
        if ( !in_array($roleName, ['admin', 'supervisor']) )
            return redirect('login');

        $unapproved = User::query()
            ->join('access_roles', 'users.role_id', '=', 'access_roles.role_id')
            ->where('approved', 0)->get(['user_id', 'fname', 'lname', 'role_name']);

        return view('registration_approval', ['unapproved' => $unapproved]);
    }

    public function approval(Request $request)
    {
        $roleName = Auth::user()->getRoleName();
        if ( !in_array($roleName, ['admin', 'supervisor']) )
            return redirect('login');
        // yes if the user clicked the "yes" checkbox, no if the user clicked the "no" checkbox
        $yes = [];
        $no = [];
        unset($request['_token']);

        foreach ($request->all() as $key => $val)
        {
            $pair = explode('_', $key);
            // formatted like ["y"\"n", user_id]
            switch ($pair[0])
            {
                case "y":
                    $yes[] = ["user_id" => $pair[1]];
                    // formatted like ["user_id": 13]
                    break;
                case "n":
                    $no[] = ["user_id" => $pair[1]];
                    // formatted like ["user_id": 13]
                    break;
            }
        }

        foreach ($yes as $user_id)
        {
            DB::table('users')
                ->where('approved', false)
                ->where('user_id', $user_id)
                ->limit(1)
                ->update(['approved' => 1]);
        }
        foreach ($no as $user_id)
        {
            DB::table('users')
                ->where('approved', false)
                ->where('user_id', $user_id)
                ->limit(1)
                ->delete();
        }

        return $this->approvalPage($request);
    }
}
