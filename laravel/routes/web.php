<?php
namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Support\Facades\Route;
use Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('home.index')->middleware('auth');
Route::get('/login', [LoginController::class, 'loginPage'])->name('login');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::get('/register-approval', [RegisterController::class, 'approvalPage'])->name('approval')->middleware('auth');

Route::post('/register', [RegisterController::class, 'store'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/register-approval', [RegisterController::class, 'approval'])->name('approval')->middleware('auth');

Route::get('/doctor-appointment', [ScheduleAppointmentsController::class, 'appointmentPage'])->name('appointments');
Route::get('/patients/list', [Patients::class, 'patientListPage'])->name('patient.list');
Route::get('/employees/list', [Employees::class, 'employeeListPage'])->name('employee.list');

Route::get('/schedule/list', [Schedules::class, 'scheduleListPage'])->name('schedules.list');
Route::get('/patient', [Patients::class, 'home'])->name('patient');

Route::get('/test', function () {
    return Auth::user()->getAccessLevel();
})->name('test')->middleware('auth');
