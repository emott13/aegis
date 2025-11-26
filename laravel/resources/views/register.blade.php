@extends('layouts/app')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
@section('content')
    <body>
        {{-- <a id="register-home" class="btn" href="{{ route('home') }}">Home</a> --}}

        <div class="container">
            <h1 class="text-center">Register</h1> 
            <br>

            {{-- Registration Form --}}
            <form action="{{ route('register.store') }}" method="POST" class="">
                @csrf
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="fname">First Name</label>
                        <input
                            class="form-control"
                            type="text"
                            id="fname"
                            name="fname"
                            value="{{ old('fname') }}"
                            placeholder="First Name"
                            required
                        >
                    </div>

                    <div class="form-group col-md-6">
                        <label for="lname">Last Name</label>
                        <input
                            class="form-control"
                            type="text"
                            id="lname"
                            name="lname"
                            value="{{ old('lname') }}"
                            placeholder="Last Name"
                            required
                            required
                        >
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="email">Email address</label>
                        <input
                            class="form-control"
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="example@example.com"
                            required
                        >
                    </div>

                    <div class="form-group col-md-6">
                        <label for="phone">Phone Number</label>
                        <input
                            class="form-control"
                            type="tel"
                            id="phone"
                            name="phone"
                            value="{{ old('phone') }}"
                            maxlength="10"
                            placeholder="7771237654"
                        >
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="password">Password</label>
                        <input
                            class="form-control"
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Password"
                            required
                        >
                        <small id="passwordHelp" class="form-text text-muted">We'll never share your password with anyone.</small>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="password">Confirm Password</label>
                        <input
                            class="form-control"
                            type="password"
                            id="password-confirm"
                            name="password_confirm"
                            placeholder="Confirm Password"
                            required
                        >
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="dob">Date of Birth</label>
                        <input
                            class="form-control"
                            type="date"
                            id="dob"
                            name="dob"
                            value="{{ old('dob') }}"
                            required
                        >
                    </div>

                    <div class="form-group col-md-6">
                        <label for="role_id">Role</label>
                        <select
                            class="form-control"
                            id="role_id"
                            name="role_id"
                            required
                        >
                            <option value="" disabled hidden selected>Select a Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->role_id }}" 
                                    {{ $role->role_id == old('role_id') ? 'selected' : "" }}>
                                    {{ ucfirst( $role->role_name ) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <br>
                <h6>Note: Your application will be reviewed before you can login.</h6>
                <div class="row">
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