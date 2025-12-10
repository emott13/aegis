<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\ValidateScheduleAssignments;
use App\Models\Schedule;
use App\Models\AccessRole;
use App\Models\User;
use App\Models\Employee;
use DB;


class Schedules extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Schedule::all();
    }

    public function scheduleListPage(Request $request)
    {
        $order = $request->input('order', 'schedule_date');

        $schedules = Schedule::with([
            'madeBy.user',
            'doctor.user',
            'supervisor.user',
            'careRed.user',
            'careBlue.user',
            'careGreen.user',
            'careYellow.user'
        ])
        ->orderByDesc($order)
        ->get();

        return view('schedule', [
            'schedules' => $schedules,
            'order' => $order
        ]);
    }

    public function scheduleCreatePage()
    {
        // $roles = AccessRole::select('access_level, role_name')->get();
        // echo $roles;
        // $doctors = User::join('access_role');
        $doctors = User::join('access_roles', 'users.role_id', '=', 'access_roles.role_id')
            ->where('access_roles.role_name', '=', 'doctor')->get();
        $supervisors = User::join('access_roles', 'users.role_id', '=', 'access_roles.role_id')
            ->where('access_roles.role_name', '=', 'supervisor')->get();
        $caregivers = User::join('access_roles', 'users.role_id', '=', 'access_roles.role_id')
            ->where('access_roles.role_name', '=', 'caregiver')->get();

        // return $doctors[0]->fname;
        return view('schedule_create', [
            'doctors' => $doctors,
            'supervisors' => $supervisors,
            'caregivers' => $caregivers,
        ]);
    }

    public function createSchedule(Request $request)
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            '*' => [new ValidateScheduleAssignments],  // full schedule validation
            'schedule_date' => ['required', 'date'],
            'made_by' => ['required', 'exists:employees,emp_id'],
            'doctor_id' => ['required', 'exists:employees,emp_id'],
            'supervisor_id' => ['required', 'exists:employees,emp_id'],
            'care_red' => ['required', 'exists:employees,emp_id'],
            'care_blue' => ['required', 'exists:employees,emp_id'],
            'care_green' => ['required', 'exists:employees,emp_id'],
            'care_yellow' => ['required', 'exists:employees,emp_id'],
        ]);

        Schedule::create($validated);

        return back()->with('success', 'Schedule saved successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Schedule::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Schedule::findOrFail($id);
        $user -> update($request->all());
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Schedule::destroy($id);
    }
}
