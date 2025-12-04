@extends('layouts/app')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Approval</title>
    {{-- temp styles. Should go in file --}}
    <style>
        .row > * {
            background-color: lightgray;
            border: 1px solid black;
        }
    </style>
</head>
@section('content')
<body>
    <h1 class="text-center">Registration Approval</h1>
    
    <form class="container">
        <input class="col" type="submit" value="Submit">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Role</th>
                    <th scope="col">Approve?</th>
                </tr>

                @foreach ($unapproved as $user)
                    <tr id="{{ $user['user_id'] }}">
                        <th scope="col">{{ $user['fname'] }}</th>
                        <th scope="col">{{ $user['lname'] }}</th>
                        <th scope="col">{{ ucwords($user['role_name']) }}</th>
                        <th scope="col">
                            <input type="checkbox" 
                                name="yes_{{ $user['user_id'] }}"
                            >Yes</input>
                            <input type="checkbox" 
                                name="no_{{ $user['user_id'] }}"
                            >No</input>
                        </th>
                    </tr>
                @endforeach
            </thead>
        </table>
    </form>
    {{-- <form class="container" action="" method="">
        <div class="row">
            <div class="col">
                Name
            </div>
            <div class="col">
                Role
            </div>
            <div class="col">
                Approved?
            </div>
        </div>

        <div class="row">
            <div class="col">
                Someone
            </div>
            <div class="col">
                Someone
            </div>
            <div class="col">
            </div>
        </div>
        </div>
    </form> --}}
</body>
@endsection
</html>