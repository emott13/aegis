<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Doctors extends Controller
{
    //

    public function home(Request $request) 
    {
        $user = Auth::user();
        // Carbon instance is to allow date functions to run (like toDateString())
        $date = Carbon::parse($request->input('date', today()->addYear()))->addDay()->addSeconds(-1);
        $doctor = $user->employee;

        if ($user->getRoleName() != 'doctor'){
            return redirect()->route('home.index');
        }

        $today = now()->toDateString();
        // $today = now();
        $appointmentsPast = Appointment::all()->where('appt_date', '<', $today)
            ->where('doctor_id', '=', $doctor->emp_id)->sortBy('appt_date');
        $appointmentsFuture = Appointment::all()->where('appt_date', '>=', $today)
            ->where('appt_date', '<', $date)
            ->where('doctor_id', '=', $doctor->emp_id)->sortBy('appt_date');

        return view('doctor_home', [ 
            'doctor' => $doctor,
            'appointmentsPast' => $appointmentsPast,
            'appointmentsFuture' => $appointmentsFuture,
            'selectedDate' => $date->toDateString()
        ]);
    }

    public function patientOfDoctor(Request $request, $patient_id)
    {
        $user = Auth::user();
        $doctor = $user->employee;

        if ($user->getRoleName() != 'doctor'){
            return redirect()->route('home.index');
        }

        $today = now()->toDateString();
        $startToday = now()->setTime(0, 0, 0)->toDateTimeString();
        $endToday = now()->setTime(23, 59, 59)->toDateTimeString();
        $appointments = Appointment::all()
            ->where('doctor_id', '=', $doctor->emp_id)
            ->where('patient_id', '=', $patient_id)
            ->sortBy('appt_date');
        $appointmentToday = boolval(count(
            Appointment::where('patient_id', '=', $patient_id)
                ->where('appt_date', '>=', $startToday)
                ->where('appt_date', '<=', $endToday)->get()
        ));

        return view('patient_of_doctor', [
            'doctor' => $doctor,
            'appointments' => $appointments,
            'patient_id' => $patient_id,
            'appointmentToday' => $appointmentToday,
        ]);
    }

    public function patientOfDoctorPost(Request $request, $patient_id)
    {
        $user = Auth::user();
        $doctor = $user->employee;

        if ($user->getRoleName() != 'doctor'){
            return redirect()->route('home.index');
        }

        $validatedAppt = $request->validate([
            'doc_comment' => 'nullable|string|max:255',
        ], []);
        $validatedPatient = $request->validate([
            'med_morn' => 'nullable|string|max:50',
            'med_noon' => 'nullable|string|max:50',
            'med_night' => 'nullable|string|max:50',
        ], []);

        $today = now()->toDateString();
        $startToday = now()->setTime(0, 0, 0)->toDateTimeString();
        $endToday = now()->setTime(23, 59, 59)->toDateTimeString();

        // $appointmentsToday = Appointment::all()
        //     ->where('doctor_id', '=', $doctor->emp_id)
        //     ->where('appt_date', '=', $today)
        //     ->where('patient_id', '=', $patient_id);
        $appt = Appointment::where('patient_id', '=', $patient_id)
            ->where('appt_date', '>=', $startToday)
            ->where('appt_date', '<=', $endToday);
        $patient = Patient::where('patient_id', '=', $patient_id);
        if ($appt && $patient)
        {
            $appt->update($validatedAppt);
            $patient->update($validatedPatient);
        }
        
        return redirect()->route('doctor.patient', ['patient_id' => $patient_id]);

    }
}
