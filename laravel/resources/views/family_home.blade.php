@extends('layouts.app')
<style>
    p, label{
        color: white;
    }
</style>
@section('content')
    <h1 class="container" style="font-weight: 600; text-align: center; color: white;">Family Home</h1>

    {{-- LINKS --}}
    {{-- <a href="{{ route('schedules.list') }}" class="btn btn-light fw-bold mb-3">View Schedule</a> --}}

    {{-- send form to patients.php for handling --}}
    <form method="POST" action="{{ route('family.home') }}">
        <label for="date">Select Record Date:</label>
        <input type="date" name="date" id="date">

        <label for="fcode">Enter Family Code:</label>
        <input type="text" name="fcode" id="fcode" placeholder="eg: FAM12345">

        <label for="pid">Enter Patient ID</label>
        <input type="number" name="pid" id="pid" placeholder="eg: 905364">

        <button type="submit">View record</button>
    </form>
@endsection