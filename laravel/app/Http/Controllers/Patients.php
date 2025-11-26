<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Patient;

class Patients extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Patient::all();
    }

    public function patientListPage()
    {
        $patients = DB::table('patients')->get();
        return view('patient_list', ['patients' => $patients]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Patient::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Patient::findOrFail($id);
        $user -> update($request->all());
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Patient::destroy($id);
    }

}
