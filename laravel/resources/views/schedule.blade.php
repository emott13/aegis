@extends('layouts.app')

@section('content')
<h1 class="container" style="font-weight: 600; text-align: center; color: white;">Schedule</h1>

@if ($schedules->count())
    <div style="width: 100%; padding: 0 10vw">

        <table class="table table-sm table-striped table-hover table-border">
            <thead>
                <tr>
                    <th><a href="{{ route('schedules.list', ['order' => 'schedule_date']) }}">Date</a></th>
                    <th><a href="{{ route('schedules.list', ['order' => 'doctor_id']) }}">Doctor</a></th>
                    <th><a href="{{ route('schedules.list', ['order' => 'supervisor_id']) }}">Supervisor</a></th>
                    <th><a href="{{ route('schedules.list', ['order' => 'care_red']) }}">Caregiver Red</a></th>
                    <th><a href="{{ route('schedules.list', ['order' => 'care_yellow']) }}">Caregiver Yellow</a></th>
                    <th><a href="{{ route('schedules.list', ['order' => 'care_green']) }}">Caregiver Green</a></th>
                    <th><a href="{{ route('schedules.list', ['order' => 'care_blue']) }}">Caregiver Blue</a></th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($schedules as $schedule)
                    <tr>
                        <td>{{ $schedule->schedule_date }}</td>
                        <td>{{ $schedule->doctor->user->full_name }}</td>
                        <td>{{ $schedule->supervisor->user->full_name }}</td>

                        <td>{{ $schedule->careRed->user->full_name }}</td>
                        <td>{{ $schedule->careBlue->user->full_name }}</td>
                        <td>{{ $schedule->careGreen->user->full_name }}</td>
                        <td>{{ $schedule->careYellow->user->full_name }}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <p style="color: white">No schedule found.</p>
@endif
@endsection