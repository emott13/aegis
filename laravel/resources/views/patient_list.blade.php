@extends('layouts.app')

@section('content')
<h1 class="container">Patient List</h1>

@if ($patients->count())
    <table class="table table-sm table-striped table-hover">
        <thead>
            <tr>
                <th>Patient ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Emergency Name</th>
                <th>Emergency Phone</th>
                <th>Emergency Relation</th>
                <th>Admission Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($patients as $patient)
                <tr>
                    <td>{{ $patient->patient_id }}</td>
                    <td>{{ $patient->fname }} {{ $patient->lname }}</td> 
                    <td>{{ $patient->age }} years</td>
                    <td>{{ $patient->em_fname }} {{ $patient->em_lname }}</td>
                    <td>{{ $patient->em_phone }}</td>
                    <td>{{ $patient->em_relation }}</td>
                    <td>{{ $patient->admission_date }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>No users found.</p>
@endif
@endsection