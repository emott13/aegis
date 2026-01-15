@extends('layouts.app')

@section('content')
<h1 class="container" style="font-weight: 600; text-align: center; color: white;">Schedule</h1>

@if ($schedules->count())
    <div style="width: 100%; padding: 0 10vw">
        @foreach ($schedules as $schedule)
            <div>
                <h3>Date: {{ $schedule->schedule_date }}</h3>
                <p>Created by:
                    {{ optional($schedule->creator?->user)->fname }}
                    {{ optional($schedule->creator?->user)->lname }}
                </p>
            </div>
            <hr>
            @foreach ($schedule->assignments as $assignment)
                <p>
                    {{ strtoupper($assignment->shift) }}
                    — {{ $assignment->employee->user->fname }}
                    ({{ $assignment->role }})
                </p>
            @endforeach
        @endforeach
    </div>
@else
    <p style="color: white">No schedule found.</p>
@endif
@endsection