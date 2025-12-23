<?php
    use App\Http\Controllers\UserController;
    function displaySalary($salary){
        $salary = preg_replace('/[^0-9]/', '', $salary);

        $newFormat = '$' . number_format($salary, 2, '.', ',');
        return $newFormat;
    }
?>

@extends('layouts.app')

@section('content')
<h1 class="container" style="font-weight: 600; text-align: center; color: white;">Employee List</h1>
    @if ($employees->count())
        <div style="width: 100%; padding: 0 10vw">
            <table class="table table-sm table-striped table-hover table-border">
                <thead>
                    <tr>
                        <th><a href="{{ route('employee.list', ['order' => 'emp_id']) }}">Employee ID</a></th>
                        <th><a href="{{ route('employee.list', ['order' => 'name']) }}">Name</a></th>
                        <th><a href="{{ route('employee.list', ['order' => 'dob']) }}">Age</a></th>
                        <th><a href="{{ route('employee.list', ['order' => 'role_name']) }}">Role</a></th>
                        <th><a href="{{ route('employee.list', ['order' => 'salary']) }}">Salary</a></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)
                        <tr>
                            <td>{{ $employee->emp_id }}</td>
                            <td>{{ $employee->fname }} {{ $employee->lname }}</td>
                            <td>{{ UserController::age($employee->dob) }} years</td>
                            <td>{{ $employee->role_name }}</td>
                            <td>{{ displaySalary($employee->salary) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div style="width: 100%; padding: 0 10vw">
            <p>No employees found.</p>
        </div>
    @endif
@endsection