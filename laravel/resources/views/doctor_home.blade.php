@extends('layouts.app')

@section('content')
    <h1 class="container text-center fw-bold">Doctor Home</h1>

{{-- LINKS --}}
<a href="{{ route('patient.list') }}" class="btn btn-light fw-bold mb-3">Patient List</a>
<a href="{{ route('schedules.list') }}" class="btn btn-light fw-bold mb-3">View Schedule</a>

{{-- PAST APPOINTMENTS --}}
@if (count($appointmentsPast))
    <table class="table table-sm table-striped table-hover table-border">
        <thead>
            <tr>
                <th>Name</th>
                <th>Date</th>
                <th>Comment</th>
                <th>Morning Med</th>
                <th>Afternoon Med</th>
                <th>Night Med</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($appointmentsPast as $appointment)
                <tr>
                    <td>{{ $appointment->patient->user->getFullNameAttribute() }}</td>
                    <td class="text-wrap">{{ $appointment->appt_date->format('m-d-Y') }}</td>
                    <td>{{ $appointment->doc_comment }}</td>
                    <td>{{ $appointment->patient->med_morn }}</td>
                    <td>{{ $appointment->patient->med_noon }}</td>
                    <td>{{ $appointment->patient->med_night }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p class="text-white">No Previous Appointments.</p>
@endif

{{-- DATE UNTIL SELECTOR --}}
<div>
    <form method="GET" action="{{ route('doctor.home') }}" class="text-white my-4">
        <label for="date" class="fw-bold">Select Date:</label>
        <input type="date" name="date" id="date" value="{{ $selectedDate }}">
        <button type="submit" class="btn btn-light fw-bold py-1">View record</button>
        <a href="{{ route('doctor.home') }}" class="btn btn-danger fw-bold py-1">Reset Date</a>
    </form>
</div>

{{-- FUTURE APPOINTMENTS (INCLUDING TODAY) --}}
@if (count($appointmentsFuture))
    <table class="table table-sm table-striped table-hover table-border">
        <thead>
            <tr>
                <th>Name</th>
                <th>Date</th>
                <th>Comment</th>
                <th>Morning Med</th>
                <th>Afternoon Med</th>
                <th>Night Med</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($appointmentsFuture as $appointment)
                <tr>
                    <td>{{ $appointment->patient->user->getFullNameAttribute() }}</td>
                    <td class="text-wrap">{{ $appointment->appt_date->format('m-d-Y') }}</td>
                    <td>{{ $appointment->doc_comment }}</td>
                    <td>{{ $appointment->patient->med_morn }}</td>
                    <td>{{ $appointment->patient->med_noon }}</td>
                    <td>{{ $appointment->patient->med_night }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p class="text-white">No Upcoming Appointments.</p>
@endif

@endsection