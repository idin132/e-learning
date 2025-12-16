<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

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

Route::get('/', function () {
    return view('layouts.main');
});

Route::resource('classes', App\Http\Controllers\ClassesController::class);
Route::resource('courses', App\Http\Controllers\CoursesController::class);
Route::resource('dashboard', App\Http\Controllers\DashboardController::class);

// Halaman Guest (Belum Login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});


Route::middleware(['auth'])->group(function () {
    // Halaman List Kelas
    Route::get('/my-classes', [CoursesController::class, 'index'])->name('my-classes');
    
    // Halaman Detail Kelas (Materi)
    Route::get('/course/{id}', [CoursesController::class, 'show'])->name('course.show');
});

// Logout (Harus Login dulu)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Contoh halaman dashboard yang diproteksi
Route::get('/overview', function () {
    return view('overview'); // Pastikan view ini ada
})->middleware('auth');