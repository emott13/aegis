<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
    public function home()
    {
        return view('family_home');
    }

    public function handleform(Request $request)
    {
        $date  = $request->input(key: 'date');
        $fcode = $request->input(key: 'fcode');
        $pid   = $request->input(key: 'pid');

        // Process the form data as needed
        // For example, you might want to validate the inputs or fetch records from the database

        // return view('family_home', compact('date', 'fcode', 'pid'));

        $patient = Patient::where('family_code', $fcode)
            ->where('patient_id', $pid)
            ->first();

        return view('family_home', data: [
            'patient' => $patient,
            'date' => $date,
            'fcode' => $fcode,
            'pid' => $pid
        ]);
    }
}
