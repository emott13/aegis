<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Care;
use App\Models\Employee;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class CaresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Care::query();

        if ($request->filled('patient_id')) {
            $query->where('patient_id', $request->patient_id);
        }

        if ($request->filled('emp_id')) {
            $query->where('emp_id', $request->emp_id);
        }

        if ($request->filled('care_date')) {
            $query->whereDate('care_date', $request->care_date);
        }

        if ($request->filled('med_morn')) {
            $query->where('med_morn', $request->boolean('med_morn'));
        }

        if ($request->filled('med_noon')) {
            $query->where('med_noon', $request->boolean('med_noon'));
        }

        if ($request->filled('med_eve')) {
            $query->where('med_eve', $request->boolean('med_eve'));
        }

        if ($request->filled('med_night')) {
            $query->where('med_night', $request->boolean('med_night'));
        }

        if ($request->filled('breakfast')) {
            $query->where('breakfast', $request->boolean('breakfast'));
        }

        if ($request->filled('lunch')) {
            $query->where('lunch', $request->boolean('lunch'));
        }

        if ($request->filled('dinner')) {
            $query->where('dinner', $request->boolean('dinner'));
        }

        return $query->get();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'patient_id' => 'required',
        'emp_id' => 'required',
        ]);

        return Care::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Care::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Care::findOrFail($id);
        $user -> update($request->all());
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Care::destroy($id);
    }


    // views


    public function caresPage(Request $request)
    {
        $sort = $request->get('sort', 'care_date');
        $direction = $request->get('direction', 'desc');

        // Safety: only allow valid directions
        $direction = in_array($direction, ['asc', 'desc']) ? $direction : 'desc';

        $query = Care::query()
            ->with(['patient.user', 'employee.user']);

        switch ($sort) {
            case 'patient':
                $query
                    ->join('patients', 'cares.patient_id', '=', 'patients.patient_id')
                    ->join('users as patient_users', 'patients.user_id', '=', 'patient_users.user_id')
                    ->orderBy('patient_users.lname', $direction)
                    ->select('cares.*');
                break;

            case 'caregiver':
                $query
                    ->join('employees', 'cares.emp_id', '=', 'employees.emp_id')
                    ->join('users as employee_users', 'employees.user_id', '=', 'employee_users.user_id')
                    ->orderBy('employee_users.lname', $direction)
                    ->select('cares.*');
                break;

            case 'care_date':
            default:
                $query->orderBy('care_date', $direction);
                break;
        }

        $cares = $query->get();

        return view('cares', compact('cares', 'sort', 'direction'));
    }

}
