<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Patient;

class Patients extends Controller
{
    // METHODS
    public function index()                                                     // Display listing of resourse // 
    {
        return Patient::all();
    }

    public function patientListPage(Request $request)                           // Display Patient List page //
    {
        $order = $request->input('order', 'patient_id');                        // default sort if none provided

        $query = DB::table('patients')                                          // base query
            ->join('users', 'patients.user_id', '=', 'users.user_id')
            ->select(
                'patients.*',
                'users.dob',
                // DB::raw('TIMESTAMPDIFF(YEAR, users.dob, CURDATE()) AS age'),
                'users.fname',
                'users.lname'
            );

        switch ($order) {                                                       // dynamic sorting based on input
            case 'name':
                $query->orderBy('users.lname')->orderBy('users.fname');
                break;

            case 'age':
                $query->orderBy('age');
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

    public function store(Request $request)                                     // Display newly created resourse //
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
