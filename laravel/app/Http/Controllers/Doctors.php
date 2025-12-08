<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Auth;
use DB;

class Doctors extends Controller
{
    //

    public function home(Request $request) 
    {
        $user = Auth::user();
        $date = $request->input('date', now()->toDateString());
        $doctor = $user->employee;

        if ($user->getRoleName() != 'doctor'){
            return redirect('home');
        }

        $appointments = Appointment::all()->sortBy('appt_date');


        return view('doctor_home', [ 
            'doctor' => $doctor,
            'appointments' => $appointments,
            'selectedDate' => $date
        ]);
    }
}
