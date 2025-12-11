<?php
// working currently
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Employee;
use App\Models\Patient;
use Auth;

class ScheduleAppointmentsController extends Controller
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

    // Return view
    public function appointmentPage()
    {
        if (!in_array(Auth::user()->getRoleName(), ['admin', 'supervisor']))
            return redirect()->route('home.index');

        $doctors = Employee::join('users', 'employees.user_id', 'users.user_id')
            ->join('access_roles', 'users.role_id', '=', 'access_roles.role_id')
            ->where('access_roles.role_name', '=', 'doctor')->get();

        $patients = Patient::join('users', 'patients.user_id', 'users.user_id')
            ->join('access_roles', 'users.role_id', '=', 'access_roles.role_id')
            ->where('access_roles.role_name', '=', 'patient')->get();

        return view('doctor_appointment', [
            'doctors' => $doctors,
            'patients' => $patients,
        ]);
    }

    public function createAppointment(Request $request)
    {
        if (!in_array(Auth::user()->getRoleName(), ['admin', 'supervisor']))
            return redirect()->route('home.index');

        $validated = $request->validate([
            'appt_date' => 'required|string|max:255|unique:appointments',
            'doctor_id' => 'required|exists:employees,emp_id',
            'patient_id' => 'required|exists:patients,patient_id',
        ],
        [ // custom error messages
        ]);
        
        Appointment::create($validated);

        return redirect()->route('appointments')->with('success', 'Appointment created successfully!');
    }
}
