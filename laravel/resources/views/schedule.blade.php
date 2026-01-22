@extends('layouts.app')
<style>
    .tableWrapper{
        border-radius: 25px;
        background-color: #1c0032ee;
        width: 80%; 
        margin: 10px auto;
        padding: 1rem 2rem;
    }
    .textColor{
        color: white;
    }
</style>
@section('content')
<h1 class="container" style="font-weight: 600; text-align: center; color: white;">Schedule</h1>

@if ($schedules->count())
    <div>
        @foreach ($schedules as $schedule)
        {{-- <hr> --}}
            <div class="tableWrapper">
                <p class="textColor">Date: {{ $schedule->schedule_date }}</p>
                <p class="textColor">Created by:
                    {{-- {{ $schedule->creator?->user->fname }} --}}
                    {{-- {{ $schedule->creator?->user->lname }} --}}
                </p>
            
                <table class="table table-sm table-striped table-hover table-border">
                    
                    <tr>
                        <th>Shift</th>
                        <th>Role</th>
                        <th>Care Group</th>
                        <th>Employee Name</th>
                    </tr>
                    @foreach ($schedule->assignments as $assignment)
                    <tr>
                        <td>{{ strtoupper($assignment->shift) }}</td>
                        <td>{{ $assignment->role }}</td>
                        <td>{{ $assignment->care_group }}</td>
                        <td>
                            {{ $assignment->employee->user->fname }}
                            {{ $assignment->employee->user->lname }}
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>    
            {{-- <hr> --}}
        @endforeach
    </div>
@else
    <p style="color: white">No schedule found.</p>
@endif
@endsection