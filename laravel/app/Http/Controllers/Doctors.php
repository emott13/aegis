<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Auth;
use DB;
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
}
