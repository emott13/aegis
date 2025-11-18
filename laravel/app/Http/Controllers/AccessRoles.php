<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccessRole;

class AccessRoles extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return AccessRole::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'role_name' => 'required',
        'access_level' => 'required',
        ]);

        return AccessRole::create($request->all());

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return AccessRole::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = AccessRole::findOrFail($id);
        $user -> update($request->all());
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return AccessRole::destroy($id);
    }
}
