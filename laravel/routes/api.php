<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users;
use App\Http\Controllers\Patients;
use App\Http\Controllers\AccessRoles;
use App\Http\Controllers\Employees;
use App\Http\Controllers\Schedules;
use App\Http\Controllers\Cares;
use App\Http\Controllers\Appointments;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('users', Users::class);
Route::resource('patients', Patients::class);
Route::resource('access_roles', AccessRoles::class);
Route::resource('employees', Employees::class);
Route::resource('schedules', Schedules::class);
Route::resource('cares', Cares::class);
Route::resource('appointments', Appointments::class);