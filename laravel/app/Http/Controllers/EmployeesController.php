<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;

class EmployeesController extends Controller
{
    // METHODS
    public function index()                                                     // Display listing of resourse // 
    {
        return Employee::all();
    }
    public function user()
    {
        return $this->belongsTo(UserController::class, 'user_id');
    }

    public function employeeListPage(Request $request)                           // Display Employee List page //
    {
        $order = $request->input('order', 'employee_id');                        // default sort if none provided

        $query = DB::table('employees')                                          // base query
            ->join('users', 'employees.user_id', '=', 'users.user_id')
            ->join('access_roles', 'users.role_id', '=', 'access_roles.role_id')
            ->select(
                'employees.*',
                'users.dob',
                'users.fname',
                'users.lname',
                'access_roles.role_name'
        );

        switch ($order) {                                                       // dynamic sorting based on input
            case 'name':
                $query->orderBy('users.lname')->orderBy('users.fname');
                break;

            case 'age':
                $query->orderBy('age');
                break;

            case 'salary':
                $query->orderBy('employees.salary');
                break;

            case 'hire_date':
                $query->orderBy('employees.hire_date');
                break;

            case 'role_name':
                $query->orderBy('access_roles.role_name');
            
            case 'emp_id':
                $query->orderBy('employees.emp_id');

            default:
                $query->orderBy('employees.emp_id');
        }

        $employees = $query->get();

        return view('employee_list', [                                           // display page
            'employees' => $employees,
            'order' => $order,
        ]);
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
