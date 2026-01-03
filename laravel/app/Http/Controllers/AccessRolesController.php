<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccessRole;

class AccessRolesController extends Controller
{
    // GET api roles
    // GET all roles
    public function index()
    {
        return AccessRole::orderBy('role_id')->get();
    }

    // POST /api/roles
    // create a new roles
    public function store(Request $request)
    {
        $data = $request->validate([
            'role_name' => 'required|string|max:20|unique:access_roles,role_name'
        ]);

        // enforce lowercase consistency for compatability with postgres
        $data['role_name'] = strtolower($data['role_name']);

        return AccessRole::create($data);

    }

    // GET /api/roles/{role}
    // GET role by ID
    public function show(AccessRole $role)
    {
        return $role;
    }

    // PUT /api/roles/{role}
    // update role
    public function update(Request $request, AccessRole $role)
    {
        $data = $request->validate([
            'role_name' => 'required|string|max:20|unique:access_roles,role_name,' . $role->role_id . ',role_id'
        ]);

        $data['role_name'] = strtolower($data['role_name']);

        $role->update($data);
        return $role;
    }

    // DELETE /api/roles/{role}
    // delete role
    public function destroy(AccessRole $role)
    {
        // Optional: prevent deleting critical roles
        if (in_array($role->role_name, ['admin', 'supervisor'])) {
            return response()->json([
                'error' => 'This role cannot be deleted'
            ], 403);
        }

        $role->delete();
        return response()->json(['message' => 'Role deleted']);
    }
}
