<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\ValidateScheduleAssignments;
use App\Models\Schedule;
use App\Models\AccessRole;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class Schedules extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = Schedule::with([
            'creator.user',
            'assignments.employee.user.role'
        ])
        ->orderBy('schedule_date')
        ->get();

        // $formatted = $schedules->map(function ($schedule) {

        //     $shifts = $schedule->assignments
        //         ->groupBy('shift')
        //         ->map(function ($shiftAssignments) {

        //             return $shiftAssignments->groupBy('role')->map(function ($roleAssignments) {
        //                 return $roleAssignments->map(function ($assignment) {
        //                     return [
        //                         'emp_id'     => $assignment->emp_id,
        //                         'name'       => $assignment->employee->user->fname . ' ' . $assignment->employee->user->lname,
        //                         'role'       => $assignment->role,
        //                         'care_group' => $assignment->care_group,
        //                     ];
        //                 });
        //             });
        //         });

        //     return [
        //         'schedule_id'   => $schedule->schedule_id,
        //         'schedule_date' => $schedule->schedule_date,
        //         'created_by'    => $schedule->creator
        //             ? $schedule->creator->user->fname . ' ' . $schedule->creator->user->lname
        //             : null,
        //         'shifts'        => $shifts,
        //     ];
        // });

        return view('schedules.index', compact('schedules'));
    }


    public function scheduleListPage(Request $request)
    {
        $schedules = Schedule::with([
            'creator',
            'assignments'
        ])
        ->orderBy('schedule_date')
        ->get();

        return view('schedule', compact('schedules'));
    }

    public function scheduleCreatePage()
    {
        if (!in_array(Auth::user()->getRoleName(), ['admin', 'supervisor']))
            return redirect()->route('home.index');

        $doctors = Employee::join('users', 'employees.user_id', 'users.user_id')
            ->join('access_roles', 'users.role_id', '=', 'access_roles.role_id')
            ->where('access_roles.role_name', '=', 'doctor')->get();
        $supervisors = Employee::join('users', 'employees.user_id', 'users.user_id')
            ->join('access_roles', 'users.role_id', '=', 'access_roles.role_id')
            ->where('access_roles.role_name', '=', 'supervisor')->get();
        $caregivers = Employee::join('users', 'employees.user_id', 'users.user_id')
            ->join('access_roles', 'users.role_id', '=', 'access_roles.role_id')
            ->where('access_roles.role_name', '=', 'caregiver')->get();

        return view('schedule_create', [
            'doctors' => $doctors,
            'supervisors' => $supervisors,
            'caregivers' => $caregivers,
        ]);
    }

    public function createSchedule(Request $request)
    {
        if (!in_array(Auth::user()->getRoleName(), ['admin', 'supervisor']))
            return redirect()->route('home.index');

        $validated = $request->validate([
            'schedule_date' => 'required|string|max:255|unique:schedules',
            'doctor_id' => 'required|exists:employees,emp_id',
            'supervisor_id' => 'required|exists:employees,emp_id',
            'care_red' => 'required|exists:employees,emp_id|different:care_yellow|different:care_green|different:care_blue',
            'care_yellow' => 'required|exists:employees,emp_id|different:care_red|different:care_green|different:care_blue',
            'care_green' => 'required|exists:employees,emp_id|different:care_red|different:care_yellow|different:care_blue',
            'care_blue' => 'required|exists:employees,emp_id|different:care_red|different:care_yellow|different:care_green',
        ],
        [ // custom error messages
            'different' => 'Caregivers cannot be in two or more groups.',
            'schedule_date.unique' => "There is already a schedule for this date.",
        ]);
        $validated['made_by'] = Auth::User()->employee->emp_id;
        
        Schedule::create($validated);

        return redirect()->route('schedules.create')->with('success', 'Schedule saved successfully!');
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

        return back();
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
