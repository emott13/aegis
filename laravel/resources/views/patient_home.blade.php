@extends('layouts.app')

@section('content')
    <h1 class="container" style="font-weight: 600; text-align: center; color: white;">Patient Home</h1>
    {{-- send form to patients.php for handling --}}
    <form method="GET" action="{{ route('patient.home') }}">
        <label for="date">Select Date:</label>
        <input type="date" name="date" id="date" value="{{ $selectedDate }}">
        <button type="submit">View record</button>
    </form>
@if ($careRecord)
    <table class="table table-sm table-striped table-hover table-border">
        <thead>
            <tr>
                <th>Med Morn</th>
                <th>Med Noon</th>
                <th>Med Night</th>
                <th>Breakfast</th>
                <th>Lunch</th>
                <th>Dinner</th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td>{{ $careRecord->med_morn ? 'Yes' : 'No' }}</td>
                    <td>{{ $careRecord->med_noon ? 'Yes' : 'No' }}</td> 
                    <td>{{ $careRecord->med_night ? 'Yes' : 'No' }}</td>
                    <td>{{ $careRecord->breakfast ? 'Yes' : 'No'}}</td>
                    <td>{{ $careRecord->lunch ? 'Yes' : 'No' }}</td>
                    <td>{{ $careRecord->dinner ? 'Yes' : 'No' }}</td>
                </tr>
        </tbody>
    </table>
@else
    <p>No record for today.</p>
@endif
@if ($appointment)
    <p>Appointment today with:</p>
    <p>Dr. {{ $appointment->doctor->user->fname }}{{ $appointment->doctor->user->lname }}</p>
@else
    <p>No appointment today.</p>
@endif
@endsection
{{-- @if ($careRecord)
    <p>Morning Meds: {{ $careRecord->med_morn ? 'Yes' : 'No' }}</p>
    <p>Afternoon Meds: {{ $careRecord->med_noon ? 'Yes' : 'No' }}</p>
    <p>Night Meds: {{ $careRecord->med_night ? 'Yes' : 'No' }}</p>
    <p>Breakfast: {{ $careRecord->breakfast ? 'Yes' : 'No' }}</p>
    <p>Lunch: {{ $careRecord->lunch ? 'Yes' : 'No' }}</p>
    <p>Dinner: {{ $careRecord->lunch ? 'Yes' : 'No' }}</p>
    <p>Caregiver: {{ $careRecord->employee->user->fname }}{{ $careRecord->employee->user->lname }}</p>
@else
    <p>No care record found for today.</p>
@endif

<h2>Your Appointment Today</h2>
@if ($appointment)
    <p>Doctor: {{ $appointment->doctor->user->fname }}{{ $appointment->doctor->user->lname }}</p>
@else
    <p>No appointment today.</p>
@endif
@endsection --}}