<?php
namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Support\Facades\Route;
// use Illuminate\Support\Facades\Auth;
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

Route::get('/', [HomeController::class, 'index'])->name('home.index')->middleware('auth');
Route::get('/login', [LoginController::class, 'loginPage'])->name('login');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::get('/register-approval', [RegisterController::class, 'approvalPage'])->name('approval')->middleware('auth');

Route::post('/register', [RegisterController::class, 'store'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/register-approval', [RegisterController::class, 'approval'])->name('approval')->middleware('auth');

// doctor home
Route::get('/doctor/home', [Doctors::class, 'home'])->name('doctor.home')->middleware('auth');

// patient of doctor
Route::get('/doctor/patient/{patient_id}', [Doctors::class, 'patientOfDoctor'])->name('doctor.patient')->middleware('auth');
Route::post('/doctor/patient/{patient_id}', [Doctors::class, 'patientOfDoctorPost'])->name('doctor.patient')->middleware('auth');

// admin or supervisor schedules patient appt with doctor
Route::get('/doctor-appointment', [ScheduleAppointmentsController::class, 'appointmentPage'])->name('appointments')->middleware('auth');
Route::post('/doctor-appointment', [ScheduleAppointmentsController::class, 'createAppointment'])->name('appointments')->middleware('auth');

Route::get('/patients/list', [PatientsController::class, 'patientListPage'])->name('patient.list');
Route::get('/employees/list', [EmployeesController::class, 'employeeListPage'])->name('employee.list');

Route::get('/patient/home', [PatientsController::class, 'home'])->name('patient.home')->middleware('auth');
Route::get('/schedule/list', [Schedules::class, 'scheduleListPage'])->name('schedules.list');
Route::get('/schedule/create', [Schedules::class, 'scheduleCreatePage'])->name('schedules.create')->middleware('auth');
Route::post('/schedule/create', [Schedules::class, 'createSchedule'])->name('schedules.create')->middleware('auth');

Route::get('/family/home', [FamilyController::class, 'home'])->name('family.home')->middleware('auth');
Route::post('/family/home', [FamilyController::class, 'handleform'])->name('family.home')->middleware('auth');

Route::get('/care/records', [CaresController::class, 'caresPage'])->name('care.records')->middleware('auth');

//route for scheduling a doc appointment
// Route::get('/schedule/appointment', [ScheduleAppointmentsController])