@extends('layouts.app')

@section('content')
    <h1 class="container" style="font-weight: 600; text-align: center; color: white;">Doctor Home</h1>

@if ($appointments)
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
            @foreach ($appointments as $appointment)
                <tr>
                    <td>{{ $appointment->patient->user->getFullNameAttribute() }}</td>
                    <td class="text-wrap">{{ $appointment->appt_date }}</td>
                    <td>{{ $appointment->doc_comment }}</td>
                    <td>{{ $appointment->patient->med_morn }}</td>
                    <td>{{ $appointment->patient->med_noon }}</td>
                    <td>{{ $appointment->patient->med_night }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>No record for today.</p>
@endif

@endsection