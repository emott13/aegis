<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PatientsController extends Controller
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
            return redirect()->route('home.index');
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
        if (!in_array(Auth::user()->getRoleName(), ['admin', 'supervisor', 'doctor', 'caregiver']))
            return redirect('login');

        $order = $request->input('order', 'patient_id');                        // default sort if none provided

        $query = DB::table('patients as p')                                          // base query
            ->join('users as u', 'p.user_id', '=', 'u.user_id')
            ->join('emergency_contacts as e', 'p.patient_id', 'e.patient_id')
            ->select(
                'p.*',
                'e.*',
                'u.dob',
                'u.email',
                'u.fname',
                'u.lname',
            );

        switch ($order) {                                                       // dynamic sorting based on input
            case 'name':
                $query->orderBy('u.lname')->orderBy('u.fname');
                break;

            case 'dob':
                $query->orderBy('dob');
                break;

            case 'em_name':
                $query->orderBy('e.em_lname')->orderBy('e.em_fname');
                break;

            case 'em_phone':
                $query->orderBy('e.em_phone');
                break;

            case 'em_relation':
                $query->orderBy('e.em_relation');
                break;

            case 'admission_date':
                $query->orderBy('p.admission_date');
                break;

            default:
                $query->orderBy('p.patient_id');
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
