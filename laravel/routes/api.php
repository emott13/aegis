<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\PatientsController;
use App\Http\Controllers\AccessRolesController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\Schedules;
use App\Http\Controllers\CaresController;
use App\Http\Controllers\AppointmentsController;

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

Route   ::  apiResource (name: 'roles', 
    controller: AccessRolesController::class);

Route   ::  middleware  (middleware: 'auth:sanctum')
        ->  get         (uri: '/user', 
        action: function (Request $request): mixed {
        return $request->user();
});

Route   ::  resource    (name: 'users', controller: UserController::class);
Route   ::  resource    (name: 'patients', controller: PatientsController::class);
Route   ::  resource    (name: 'employees', controller: EmployeesController::class);
Route   ::  resource    (name: 'schedules', controller: Schedules::class);
Route   ::  resource    (name: 'cares', controller: CaresController::class);
Route   ::  resource    (name: 'appointments', controller: AppointmentsController::class);
Route   ::  apiResource (name: 'roles', controller: AccessRolesController::class);