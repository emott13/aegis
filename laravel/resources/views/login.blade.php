@extends('layouts/app')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
@section('content')
    <body>
        <div class="container">
            <h1 class="text-center">Login</h1> 
            <br>

            {{-- Login Form --}}
            <form action="{{ route('login') }}" method="POST" class="">
                @csrf
                <div class="row">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input
                            class="form-control"
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Email"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input
                            class="form-control"
                            type="password"
                            id="password"
                            name="password"
                            value="{{ old('password') }}"
                            placeholder="Password"
                            required
                        >
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