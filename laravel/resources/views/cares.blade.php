@extends('layouts.app')

@php
    function sortLink($label, $column){
        $direction = request('direction') === 'asc' ? 'desc' : 'asc';
        return route('care.records', [
            'sort' => $column,
            'direction' => $direction
        ]);
    }
@endphp

@section('content')
<h1 class="container" style="font-weight: 600; text-align: center; color: white;">Record List</h1>
    @if ($cares->count())
        <div style="width: 100%; padding: 0 10vw">
            <table class="table table-sm table-striped table-hover table-border">
                <thead>
                    <tr>
                        <th><a href="{{ sortLink('Date', 'care_date') }}">Record Date</a></th>
                        <th><a href="{{ sortLink('Patient', 'patient') }}">Patient Name</a></th>
                        <th><a href="{{ sortLink('Caregiver', 'caregiver') }}">Caregiver Name</a></th>
                        <th>Morning Meds</th>
                        <th>Noon Meds</th>
                        <th>Evening Meds</th>
                        <th>Night Meds</th>
                        <th>Breakfast</th>
                        <th>Lunch</th>
                        <th>Dinner</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cares as $care)
                        <tr>
                            <td>{{ $care->care_date }}</td>
                            <td>
                                {{ $care->patient->user->fname }}
                                {{ $care->patient->user->lname }}
                            </td>
                            <td>
                                {{ $care->employee->user->fname }}
                                {{ $care->employee->user->lname }}
                            </td>
                            <td>{{ $care->med_morn }}</td>
                            <td>{{ $care->med_noon }}</td>
                            <td>{{ $care->med_eve }}</td>
                            <td>{{ $care->med_night }}</td>
                            <td>{{ $care->breakfast }}</td>
                            <td>{{ $care->lunch }}</td>
                            <td>{{ $care->dinner }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div style="width: 100%; padding: 0 10vw">
            <p>No records found.</p>
        </div>
    @endif
@endsection