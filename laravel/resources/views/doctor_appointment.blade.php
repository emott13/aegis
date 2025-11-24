@extends('layouts.app')

@section('content')
    <form>
        <div class="input-group">
            <span class="input-group-text">Patient ID:</span>
            <input type="text" class="form-control">
        </div>
        <div class="input-group">
            <span class="input-group-text">Appointment Date:</span>
            <input type="text" class="form-control">
        </div>
        <select name="" id="" class="form-select">
            <option value="selected">Choose a doctor:</option>
            <option value="1">example</option>
        </select>
    </form>
@endsection