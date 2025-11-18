<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Care;

class Cares extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Care::all();
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
}
