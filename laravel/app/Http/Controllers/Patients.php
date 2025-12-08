<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Patients extends Controller
{
    // METHODS
    public function index()                                                     // Display listing of resource // 
    {
        return Patient::all();
    }

    public function home(Request $request)                                      // Function for Patient Home Page //
    {
        $user = Auth::user();                                                   // authenticate current user
        $date = $request->input('date', now()->toDateString());                 // default to current date
        $patient = $user->patient;                                              // ensure user is patient

        if (!$patient){                                                         // redirect if user is not patient
            return view('home');
        }

        $careRecord = $patient->cares()                                         // retrieve care record
            ->where('care_date', $date)
            ->with('employee.user')                                             // caregiver + caregiver name
            ->first();

        $appointment = $patient->appointments()                                 // retrieve appt info
            ->where('appt_date', $date)
            ->with(['doctor.user'])                                             // doctor + doctor name
            ->first();

        return view('patient_home', [                                           // display page
            'patient' => $patient,
            'careRecord' => $careRecord,
            'appointment' => $appointment,
            'selectedDate' => $date
        ]);
    }

    public function patientListPage(Request $request)                           // Display Patient List page //
    {
        $order = $request->input('order', 'patient_id');                        // default sort if none provided

        $query = DB::table('patients')                                          // base query
            ->join('users', 'patients.user_id', '=', 'users.user_id')
            ->select(
                'patients.*',
                'users.dob',
                'users.email',
                'users.fname',
                'users.lname'
            );

        switch ($order) {                                                       // dynamic sorting based on input
            case 'name':
                $query->orderBy('users.lname')->orderBy('users.fname');
                break;

            case 'dob':
                $query->orderBy('dob');
                break;

            case 'em_name':
                $query->orderBy('patients.em_lname')->orderBy('patients.em_fname');
                break;

            case 'em_phone':
                $query->orderBy('patients.em_phone');
                break;

            case 'em_relation':
                $query->orderBy('patients.em_relation');
                break;

            case 'admission_date':
                $query->orderBy('patients.admission_date');
                break;

            default:
                $query->orderBy('patients.patient_id');
        }

        $patients = $query->get();

        return view('patient_list', [                                           // display page
            'patients' => $patients,
            'order' => $order
        ]);
    }

    public function store(Request $request)                                     // Display newly created resource //
    {
        $request->validate([
        'family_code' => 'required',
        'em_fname' => 'required',
        'em_lname' => 'required',
        'em_phone' => 'required',
        'em_relation' => 'required',
        'admission_date' => 'required',
        'care_group' => 'required',
        'med_morn' => 'required',
        'med_noon' => 'required',
        'med_night' => 'required',
        'bill_amount' => 'required',
        'user_id' => 'required'
        ]);

        return Patient::create($request->all());
    }

    public function show(string $id)                                            // Display specified resourse //
    {
        return Patient::findOrFail($id);
    }

    public function update(Request $request, string $id)                        // Update specified resourse //
    {
        $user = Patient::findOrFail($id);
        $user -> update($request->all());
        return $user;
    }

    public function destroy(string $id)                                         // Remove specified resourse //
    {
        return Patient::destroy($id);
    }

}
