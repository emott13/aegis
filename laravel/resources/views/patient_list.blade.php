<?php

function formatPhoneNumber($phoneNumber) {

    $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);

    if (strlen($phoneNumber) == 10) {
        return preg_replace('/(\d{3})(\d{3})(\d{4})/', '($1) $2-$3', $phoneNumber);
    } 
    else if (strlen($phoneNumber) == 11 && substr($phoneNumber, 0, 1) == '1') {
        return preg_replace('/1(\d{3})(\d{3})(\d{4})/', '1 ($1) $2-$3', $phoneNumber);
    }
    return $phoneNumber;
}

?>

@extends('layouts.app')

@section('content')
<h1 class="container" style="font-weight: 600; text-align: center; color: white;">Patient List</h1>

@if ($patients->count())
    <div style="width: 100%; padding: 0 10vw">

        <table class="table table-sm table-striped table-hover table-border">
            <thead>
                <tr>
                    <th><a href="{{ route('patient.list', ['order' => 'patient_id']) }}">Patient ID</a></th>
                    <th><a href="{{ route('patient.list', ['order' => 'name']) }}">Name</a></th>
                    <th><a href="{{ route('patient.list', ['order' => 'age']) }}">Age</a></th>
                    <th><a href="{{ route('patient.list', ['order' => 'em_name']) }}">Emergency Contact Name</a></th>
                    <th><a href="{{ route('patient.list', ['order' => 'em_phone']) }}">Emergency Phone</a></th>
                    <th><a href="{{ route('patient.list', ['order' => 'em_relation']) }}">Emergency Relation</a></th>
                    <th><a href="{{ route('patient.list', ['order' => 'admission_date']) }}">Admission Date</a></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($patients as $patient)
                    <tr>
                        <td>{{ $patient->patient_id }}</td>
                        <td>{{ $patient->fname }} {{ $patient->lname }}</td> 
                        <td>{{ $patient->age }} years</td>
                        <td>{{ $patient->em_fname }} {{ $patient->em_lname }}</td>
                        <td>{{ formatPhoneNumber($patient->em_phone) }}</td>
                        <td>{{ $patient->em_relation }}</td>
                        <td>{{ $patient->admission_date }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <p>No users found.</p>
@endif
@endsection