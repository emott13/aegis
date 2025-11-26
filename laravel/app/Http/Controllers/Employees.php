<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;

class Employees extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Employee::all();
    }

    public function employeeListPage()
    {   // needs access roles to determine if user can visit page
        $employees = DB::table('employees')->get();
        return view('employee_list', ['employees' => $employees]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'user_id' => 'required'
        ]);

        return Employee::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Employee::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Employee::findOrFail($id);
        $user -> update($request->all());
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Employee::destroy($id);
    }
}
