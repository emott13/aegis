@extends('layouts.app')

@section('content')
<h1>Employee List</h1>

@if ($employees->count())
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Role</th>
                <th>Salary</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
                <tr>
                    <td>{{ $employee->emp_id }}</td>
                    <td>{{-- <td>{{ $employee->fname }} {{ $employee->lname }}</td> --}}</td>
                    <td>{{-- access role name --}}</td>
                    <td>{{ $employee->salary }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>No employees found.</p>
@endif
@endsection