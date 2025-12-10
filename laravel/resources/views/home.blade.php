@extends('layouts.app')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
@section('content')
{{-- <div class="container" data-bs-theme="dark">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div> --}}
<div class="container mt-2 alert" style="background-color: #333; border: 1px solid #454545">
    @if (in_array($role, ['admin', 'supervisor']))
        <a href="{{ route('schedules.create') }}" class="btn btn-primary fw-bold mb-3">Create Schedule</a>
    @endif
    
    <a href="{{ route('schedules.list') }}" class="btn btn-primary fw-bold mb-3">View Schedule</a>

    @if (in_array($role, ['admin', 'supervisor']))
        <a href="{{ route('appointments') }}" class="btn btn-primary fw-bold mb-3">Create Appointment</a>
    @endif
    @if (in_array($role, ['admin', 'supervisor']))
        <a href="{{ route('employee.list') }}" class="btn btn-primary fw-bold mb-3">View Employees</a>
    @endif
    @if (in_array($role, ['admin', 'supervisor', 'caregivers']))
        <a href="{{ route('patient.list') }}" class="btn btn-primary fw-bold mb-3">View Patients</a>
    @endif
    @if (in_array($role, ['admin', 'supervisor']))
        <a href="{{ route('approval') }}" class="btn btn-primary fw-bold mb-3">Approve Users</a>
    @endif

</div>

</body>
@endsection
