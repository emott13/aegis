{{-- @extends('layouts/app') --}}
@extends('layouts.app')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Schedule</title>
</head>
<style>
    .main-form label,
    form > small {
        color: white;
    }
</style>
@section('content')
    <body>
        <div class="container">
            <h1 class="text-center mb-3">Create Schedule</h1> 

            {{-- Success Message --}}
            @if (session('success'))
                <div id="success" class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- New Roster/Schedule Form --}}
            <form action="{{ route('schedules.create') }}" method="POST" class="">
                @csrf
                <div class="main-form">
                    <div class="row mb-3">
                        <div class="form-group col-md-6">
                            <label for="schedule_date">Date</label>
                            <input
                                class="form-control"
                                type="date"
                                id="schedule_date"
                                name="schedule_date"
                                value="{{ old('schedule_date') }}"
                                required
                            >
                        </div>
                    </div>

                    <div class="row mb-3">
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
                                        {{ ucfirst( $doctor->getFullNameAttribute() ) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="supervisor_id">Supervisor</label>
                            <select
                                class="form-control"
                                id="supervisor_id"
                                name="supervisor_id"
                                required
                            >
                                <option value="" disabled hidden selected>Select a supervisor</option>
                                @foreach ($supervisors as $supervisor)
                                    <option value="{{ $supervisor->emp_id }}" 
                                        {{ $supervisor->emp_id == old('supervisor_id') ? 'selected' : "" }}>
                                        {{ ucfirst( $supervisor->getFullNameAttribute() ) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="form-group col-md-6">
                            <label for="care_red">Caregiver Red</label>
                            <select
                                class="form-control"
                                id="care_red"
                                name="care_red"
                                required
                            >
                                <option value="" disabled hidden selected>Select a caregiver</option>
                                @foreach ($caregivers as $caregiver)
                                    <option value="{{ $caregiver->emp_id }}" 
                                        {{ $caregiver->emp_id == old('care_red') ? 'selected' : "" }}>
                                        {{ ucfirst( $caregiver->getFullNameAttribute() ) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="care_yellow">Caregiver Yellow</label>
                            <select
                                class="form-control"
                                id="care_yellow"
                                name="care_yellow"
                                required
                            >
                                <option value="" disabled hidden selected>Select a caregiver</option>
                                @foreach ($caregivers as $caregiver)
                                    <option value="{{ $caregiver->emp_id }}" 
                                        {{ $caregiver->emp_id == old('care_yellow') ? 'selected' : "" }}>
                                        {{ ucfirst( $caregiver->getFullNameAttribute() ) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="form-group col-md-6">
                            <label for="care_green">Caregiver Green</label>
                            <select
                                class="form-control"
                                id="care_green"
                                name="care_green"
                                required
                            >
                                <option value="" disabled hidden selected>Select a caregiver</option>
                                @foreach ($caregivers as $caregiver)
                                    <option value="{{ $caregiver->emp_id }}" 
                                        {{ $caregiver->emp_id == old('care_green') ? 'selected' : "" }}>
                                        {{ ucfirst( $caregiver->getFullNameAttribute() ) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="care_blue">Caregiver Blue</label>
                            <select
                                class="form-control"
                                id="care_blue"
                                name="care_blue"
                                required
                            >
                                <option value="" disabled hidden selected>Select a caregiver</option>
                                @foreach ($caregivers as $caregiver)
                                    <option value="{{ $caregiver->emp_id }}" 
                                        {{ $caregiver->emp_id == old('care_blue') ? 'selected' : "" }}>
                                        {{ ucfirst( $caregiver->getFullNameAttribute() ) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="form-group col">
                        <button type="submit" class="btn btn-primary form-control">Sign in</button>
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