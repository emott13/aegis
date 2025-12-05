<?php
// working currently
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;

class AppointmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Appointment::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'appt_date' => 'required',
        'patient_id' => 'required',
        'doctor_id' => 'required',
        ]);

        return Appointment::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Appointment::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Appointment::findOrFail($id);
        $user -> update($request->all());
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Appointment::destroy($id);
    }

}
