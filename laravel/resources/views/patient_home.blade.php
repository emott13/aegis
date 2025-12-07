@php
    $today = date('Y-m-d')
@endphp
@extends('layouts.app')
@section('content')
    <h1 class="container" style="font-weight: 600; text-align: center; color: white;">Patient Home</h1>
    {{-- send form to patients.php for handling --}}
    <form action="{{ route('patient') }}"> 
        <input type="number" name="pid" id="pid" placeholder="Patient ID" required>
        <input type="text" name="fid" id="fid" placeholder="Family Code" required>
        <input type="date" name="date" id="date" value="{{ $today }}">
        <input type="text" name="p_name" id="p_name" placeholder="Patient Name" readonly>
    </form>
@if ($patients->count())
    <table class="table table-sm table-striped table-hover table-border">
        <thead>
            <tr>
                <th>Patient ID</th>
                <th>Family Code</th>
                <th>Med Morn</th>
                <th>Med Noon</th>
                <th>Med Night</th>
                <th>Breakfast</th>
                <th>Lunch</th>
                <th>Dinner</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($patients as $patient)
                <tr>
                    <td>{{ $patient->patient_id }}</td>
                    <td>{{ $patient->family_code }}</td> 
                    <td>{{ $patient->med_morn }}</td>
                    <td>{{ $patient->med_noon }}</td>
                    <td>{{ $patient->med_night }}</td>
                    <td>{{ $patient->breakfast }}</td>
                    <td>{{ $patient->lunch }}</td>
                    <td>{{ $patient->dinner }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif
@endsection