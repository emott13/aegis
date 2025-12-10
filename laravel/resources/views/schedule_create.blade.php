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
            <h1 class="text-center">Register</h1> 
            <br>

            {{-- New Roster/Schedule Form --}}
            <form action="{{ route('schedules.create') }}" method="POST" class="">
                @csrf
                <div class="main-form">
                    <div class="row mb-3">
                        <div class="form-group col-md-6">
                            <label for="date">Date</label>
                            <input
                                class="form-control"
                                type="date"
                                id="date"
                                name="date"
                                value="{{ old('date') }}"
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
                                    <option value="{{ $doctor->user_id }}" 
                                        {{ $doctor->user_id == old('doctor_id') ? 'selected' : "" }}>
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
                                    <option value="{{ $supervisor->user_id }}" 
                                        {{ $supervisor->user_id == old('supervisor_id') ? 'selected' : "" }}>
                                        {{ ucfirst( $supervisor->getFullNameAttribute() ) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="form-group col-md-6">
                            <label for="caregiver_red_id">Caregiver Red</label>
                            <select
                                class="form-control"
                                id="caregiver_red_id"
                                name="caregiver_red_id"
                                required
                            >
                                <option value="" disabled hidden selected>Select a caregiver</option>
                                @foreach ($caregivers as $caregiver)
                                    <option value="{{ $caregiver->user_id }}" 
                                        {{ $caregiver->user_id == old('caregiver_id') ? 'selected' : "" }}>
                                        {{ ucfirst( $caregiver->getFullNameAttribute() ) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="caregiver_yellow_id">Caregiver Yellow</label>
                            <select
                                class="form-control"
                                id="caregiver_yellow_id"
                                name="caregiver_yellow_id"
                                required
                            >
                                <option value="" disabled hidden selected>Select a caregiver</option>
                                @foreach ($caregivers as $caregiver)
                                    <option value="{{ $caregiver->user_id }}" 
                                        {{ $caregiver->user_id == old('caregiver_id') ? 'selected' : "" }}>
                                        {{ ucfirst( $caregiver->getFullNameAttribute() ) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="form-group col-md-6">
                            <label for="caregiver_green_id">Caregiver Green</label>
                            <select
                                class="form-control"
                                id="caregiver_green_id"
                                name="caregiver_green_id"
                                required
                            >
                                <option value="" disabled hidden selected>Select a caregiver</option>
                                @foreach ($caregivers as $caregiver)
                                    <option value="{{ $caregiver->user_id }}" 
                                        {{ $caregiver->user_id == old('caregiver_id') ? 'selected' : "" }}>
                                        {{ ucfirst( $caregiver->getFullNameAttribute() ) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="caregiver_blue_id">Caregiver Blue</label>
                            <select
                                class="form-control"
                                id="caregiver_blue_id"
                                name="caregiver_blue_id"
                                required
                            >
                                <option value="" disabled hidden selected>Select a caregiver</option>
                                @foreach ($caregivers as $caregiver)
                                    <option value="{{ $caregiver->user_id }}" 
                                        {{ $caregiver->user_id == old('caregiver_id') ? 'selected' : "" }}>
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