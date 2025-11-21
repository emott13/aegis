@extends('master')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
@section('content')
    <body>
        <h1>Home Page</h1> 

        <a id="home-login" class="btn" href="{{ route('login') }}">Login</a>
        <br>
        <a id="home-register" class="btn" href="{{ route('register') }}">Register</a>
    </body>
@endsection
</html>