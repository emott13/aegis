@extends('layouts.app')
<style>
    p, label{
        color: white;
    }
</style>
@section('content')
    <h1 class="container" style="font-weight: 600; text-align: center; color: white;">Patient Home</h1>
    {{-- send form to patients.php for handling --}}
    <form method="GET" action="{{ route('patient.home') }}">
        <label for="date">Select Date:</label>
        <input type="date" name="date" id="date" value="{{ $selectedDate }}">
        <button type="submit">View record</button>
    </form>
@if ($careRecord)
    <div style="width: 100%; padding: 0 10vw">
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
    </div>
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