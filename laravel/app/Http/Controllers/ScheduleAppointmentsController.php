<?php
// working currently
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Employee;
use App\Models\Patient;
use App\Models\Schedule;
use App\Models\ScheduleAssignment;
use Illuminate\Support\Facades\Auth;
use RuntimeException;

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
        // 'appt_time' => 'required',
        'appt_comment' => 'required',
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

        //get date / default today

        $date = date('d M Y', time());
        $schedule = Schedule::where('schedule_date', '=', $date)->get();
        // $scheduleId = $schedule->schedule_id;
        if (!$schedule){
            throw new RuntimeException('No schedule for this date {{ $date }}.');
        }

        $doctorAssignment = ScheduleAssignment::join('schedules as s', 'schedule_assignments.schedule_id', 's.schedule_id')
            ->join('employees as e', 'schedule_assignments.emp_id', 'e.emp_id')
            ->join('users as u', 'e.user_id', 'u.user_id')
            ->where('role', '=', 'doctor')
            ->where('schedule_date', '=', $date)
            ->get();
        if(!$doctorAssignment){
            throw new RuntimeException('No doctors scheduled for this day.');
        }

        $patients = Patient::join('users', 'patients.user_id', 'users.user_id')
            ->join('access_roles', 'users.role_id', '=', 'access_roles.role_id')
            ->where('access_roles.role_name', '=', 'patient')->get();

        return view('doctor_appointment', [
            'doctors' => $doctorAssignment,
            'patients' => $patients,
        ]);
    }

    public function createAppointment(Request $request)
    {
        if (!in_array(Auth::user()->getRoleName(), ['admin', 'supervisor']))
            return redirect()->route('home.index');

        $validated = $request->validate([
            'appt_date' => 'required|string|max:255|unique:appointments',
            // 'appt_time' => 'required|time',
            'appt_comment' => 'string|max:255',
            // 'doctor_id' => 'required|exists:employees,emp_id',
            'patient_id' => 'required|exists:patients,patient_id',
        ],
        [ 
            "Date is required!",
        ]);
        
        Appointment::create($validated);

        return redirect()->route('appointments')->with('success', 'Appointment created successfully!');
    }
}
