@extends('layouts.app')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Appointment</title>
    @vite('resources/js/doctor_appointment.js')
</head>
<style>
    .main-form label,
    form > small {
        /* color: white; */
    }
</style>
@section('content')
    <body>
        <div class="container">
            <h1 class="text-center mb-3">Create Appointment</h1>

            {{-- Success Message --}}
            @if (session('success'))
                <div id="success" class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Doctor Appointment Creation Form --}}
            <form action="{{ route('appointments') }}" method="POST" class="">
                @csrf
                <div class="main-form">
                    <div class="row mb-3">
                        <div class="form-group col-md-6">
                            <label for="patient_id">Patient ID</label>
                            <select
                                class="form-control"
                                id="patient_id"
                                name="patient_id"
                                required
                            >
                                <option value="" disabled hidden selected>Select a Patient ID</option>
                                @foreach ($patients as $patient)
                                    <option value="{{ $patient->patient_id }}" 
                                        {{ $patient->patient_id == old('patient_id') ? 'selected' : "" }}>
                                        {{ ucfirst( $patient->patient_id ) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="patient_id">Patient Name</label>
                            <div id="patient-name">
                                <p id="patient-name-placeholder" class="form-control text-muted ">Select a Patient ID First</p>
                                @foreach ($patients as $patient)
                                    <p id="patient-name-{{ $patient->patient_id }}" class="form-control text-muted " hidden>{{ $patient->user->getFullNameAttribute() }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="form-group col-md-6">
                            <label for="appt_date">Date</label>
                            <input
                                class="form-control"
                                type="date"
                                id="appt_date"
                                name="appt_date"
                                value="{{ old('appt_date') }}"
                                required
                            >
                        </div>
                        {{-- <div class="form-group col-md-6">
                            <label for="appt_date">Time</label>
                            <input
                                class="form-control"
                                type="time"
                                id="appt_time"
                                name="appt_time"
                                value="{{ old('appt_time') }}"
                                required
                            >
                        </div> --}}
                        <div class="form-group col-md-6">
                            <label for="doctor_id">Doctor</label>
                            <select
                                class="form-control"
                                id="doctor_id"
                                name="doctor_id"
                                required
                            >
                                <option value="" disabled hidden selected>Select a doctor</option>
                                @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->emp_id }}" 
                                        {{ $doctor->emp_id == old('doctor_id') ? 'selected' : "" }}>
                                        {{ ucfirst( $doctor->emp_id ) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="form-group col">
                        <button type="submit" class="btn btn-primary form-control">Create</button>
                    </div>
                </div>
                {{-- Validation errors --}}
                @if ($errors->any())
                    <ul class="alert alert-danger mt-2" role="alert">
                        @foreach ($errors->all() as $error)
                            <li class="list-group-item">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

            </form>
        </div>
    </body>
@endsection
</html>