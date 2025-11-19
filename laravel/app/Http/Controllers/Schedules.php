<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'schedule_date' => 'required',
        'made_by' => 'required',
        'doctor_id' => 'required',
        'supervisor_id' => 'required',
        'care_red' => 'required',
        'care_blue' => 'required',
        'care_green' => 'required',
        'care_yellow' => 'required',
        ]);

        return Schedule::create($request->all());
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
