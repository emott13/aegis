<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\ValidateScheduleAssignments;
use App\Models\Schedule;

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
