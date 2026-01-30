@extends('layouts.app')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Of Doctor</title>
</head>
<style>
    /* .main-form label,
    form > small {
        color: white;
    } */
    .tableWrapper{
        border-radius: 25px;
        background-color: #1c0032ee;
        width: 80%; 
        margin: 10px auto;
        padding: 1rem 2rem;
    }
    .container, 
    .container > h1,
    .container > h4{
        /* color: black; */
        /* #1c0032 */
    }
</style>

@section('content')
<div class="tableWrapper">
    <h1 class="container text-center fw-bold mb-3">Patient of Doctor</h1>

{{-- LINKS --}}

{{-- PAST APPOINTMENTS --}}
@if (count($appointments))
    <table class="table table-sm table-striped table-hover table-border">
        <thead>
            <tr>
                <th>Name</th>
                <th>Appt Date</th>
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
                    <td class="text-wrap">{{ $appointment->appt_date->format('m-d-Y') }}</td>
                    <td>{{ $appointment->doc_comment }}</td>
                    <td>{{ $appointment->patient->med_morn }}</td>
                    <td>{{ $appointment->patient->med_noon }}</td>
                    <td>{{ $appointment->patient->med_night }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <h4 class="text-center">You have no past appointments with this patient</h4>
@endif

{{-- NEW NOTE AND MEDS --}}
<div class="container">
    <h1 class="text-center mt-5 fw-bold">New Prescription</h1> 

    {{-- NEW PERSCRIPTION FORM --}}
    @if ($appointmentToday)
        <form action="{{ route('doctor.patient', ['patient_id' => $patient_id]) }}" method="POST" class="">
            @csrf
            <div class="main-form">
                <div class="row mb-3">
                    <div class="form-group col-md-6">
                        <label for="doc_comment">Comment</label>
                        <input
                            class="form-control"
                            type="text"
                            id="doc_comment"
                            name="doc_comment"
                            value="{{ old('doc_comment') }}"
                            placeholder="Comment"
                            
                        >
                    </div>

                    <div class="form-group col-md-6">
                        <label for="med_morn">Morning Med</label>
                        <input
                            class="form-control"
                            type="text"
                            id="med_morn"
                            name="med_morn"
                            value="{{ old('med_morn') }}"
                            placeholder="Morning Med"
                            
                        >
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="form-group col-md-6">
                        <label for="med_noon">Afternoon Med</label>
                        <input
                            class="form-control"
                            type="text"
                            id="med_noon"
                            name="med_noon"
                            value="{{ old('med_noon') }}"
                            placeholder="Afternoon Med"
                            
                        >
                    </div>

                    <div class="form-group col-md-6">
                        <label for="med_night">Night Med</label>
                        <input
                            class="form-control"
                            type="text"
                            id="med_night"
                            name="med_night"
                            value="{{ old('med_night') }}"
                            placeholder="Night Med"
                            
                        >
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="form-group col">
                    <button type="submit" class="btn btn-primary form-control">Submit</button>
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
    @else
        <h4 class="text-center">This patient has no appointments with you today.</h4>
    @endif
</div>
</div>

@endsection