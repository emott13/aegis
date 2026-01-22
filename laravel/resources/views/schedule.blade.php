@extends('layouts.app')

@section('content')
<h1 class="container" style="font-weight: 600; text-align: center; color: white;">Schedule</h1>

@if ($schedules->count())
    <div style="width: 100%; padding: 0 10vw">
        @foreach ($schedules as $schedule)
            <div>
                <p>Date: {{ $schedule->schedule_date }}</p>
                <p>Created by:
                    {{-- {{ $schedule->creator?->user->fname }} --}}
                    {{-- {{ $schedule->creator?->user->lname }} --}}
                </p>
            </div>
            <hr>
            @foreach ($schedule->assignments as $assignment)
            <table class="table table-sm table-striped table-hover table-border container">
                <tr>
                    <th>Shift</th>
                    <th>Role</th>
                    <th>Care Group</th>
                    <th>Employee Name</th>
                </tr>
                <tr>
                    <td>{{ strtoupper($assignment->shift) }}</td>
                    <td>{{ $assignment->role }}</td>
                    <td>{{ $assignment->care_group }}</td>
                    <td>
                        {{ $assignment->employee->user->fname }}
                        {{ $assignment->employee->user->lname }}
                    </td>
                </tr>
            </table>
                {{-- <p>
                    
                    — 
                    
                </p>
                <p>{{ $assignment->schedule_id }}</p>
                <p>{{ $assignment->emp_id }}</p> --}}
            @endforeach
            <hr>
        @endforeach
    </div>
@else
    <p style="color: white">No schedule found.</p>
@endif
@endsection