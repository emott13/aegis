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
        <h1>Login Page</h1> 

        <a id="login-home" class="btn" href="{{ route('home') }}">Home</a>
    </body>
@endsection
</html>