@extends('layouts.app')

@section('content')
<h1>Patient List</h1>

@if ($patients->count())
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>EM Name</th>
                <th>EM Phone</th>
                <th>EM Relation</th>
                <th>Admission Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($patients as $patient)
                <tr>
                    <td>{{ $patient->id }}</td>
                    <td>{{ $patient->fname }} {{ $patient->lname }}</td>
                    <td>{{ $patient->dob }}</td>
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