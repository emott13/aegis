@extends('layouts.app')
<style>
    p, label{
        color: white;
    }

    .sctn_dv{
        display: flex;
        flex-direction: column;
        align-content: center;
        justify-content: space-between;
        width: 800px;
        margin: 2rem auto;
        padding: 20px;
        border-radius: 10px;
        border: 1px solid rgba(255, 255, 255, 0.5);
        margin-top: 20px;
        box-shadow: inset 0 0 10px rgb(255, 255, 255);
    }

    .form{
        column-count: 2;
    }
    
    .form-item{
        margin-top: 15px;
    }

    .form_label{
        font-weight: 500;
        font-size: 18px;
    }

</style>
@section('content')
    <h1 class="container" style="font-weight: 600; text-align: center; color: white;">Family Home</h1>

    {{-- LINKS --}}
    {{-- <a href="{{ route('schedules.list') }}" class="btn btn-light fw-bold mb-3">View Schedule</a> --}}

    {{-- send form to patients.php for handling --}}
<div class="sctn_dv">
    <form method="POST" action="{{ route('family.home') }}" class="form">
        <div>
            <label for="date" class="form-item form_label">Select Record Date:</label>
            <input type="date" name="date" id="date" class="form-item">
        </div>

        <div>
            <label for="fcode" class="form-item form_label">Enter Family Code:</label>
            <input type="text" name="fcode" id="fcode" class="form-item" placeholder="eg: FAM12345">
        </div>


        <div>
            <label for="pid" class="form-item form_label">Enter Patient ID</label>
            <input type="number" name="pid" id="pid" class="form-item" placeholder="eg: 905364">
        </div>

        <div>
            <button type="submit" class="form-item">View record</button>
        </div>
    </form>
</div>
<div>
    @if(isset($patient))
        <div class="sctn_dv">
            <h2 style="text-align: center; color: white;">Patient Information</h2>
            <p><strong>Name:</strong> {{ $patient->name }}</p>
            <p><strong>Age:</strong> {{ $patient->age }}</p>


            <p>bill amount: {{ $patient->bill_amount }}</p>
        </div>
    @endif
</div>
    
@endsection