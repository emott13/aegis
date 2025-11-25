<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use Auth;
// use App\Http\Controllers\RegisterController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [LoginController::class, 'loginPage'])->name('login');
Route::get('/register', [RegisterController::class, 'registerPage'])->name('register');
// Auth::routes();
Route::get('/doctor-appointment', [ScheduleAppointmentsController::class, 'appointmentPage'])->name('appointments');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
