<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TeacherMaterialController;
use App\Http\Controllers\TeacherChapterController;
use App\Http\Controllers\StudentsController;

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
    return view('auth.login');
});

Route::resource('classes', App\Http\Controllers\ClassesController::class);
Route::resource('courses', App\Http\Controllers\CoursesController::class);
Route::resource('dashboard', App\Http\Controllers\DashboardController::class);
route::resource('students', App\Http\Controllers\StudentsController::class);
route::get('/course-material', [TeacherMaterialController::class, 'index'])->name('teacher-material.index');

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

Route::middleware(['auth', 'role:teacher'])->prefix('teacher')->group(function () {

    // Form Tambah Materi (Butuh ID Chapter)
    Route::get('/chapter/{chapterId}/material/create', [TeacherMaterialController::class, 'create'])->name('teacher.material.create');
    Route::post('/chapter/{chapterId}/material', [TeacherMaterialController::class, 'store'])->name('teacher.material.store');

    // Edit & Hapus Materi (Butuh ID Material)
    Route::get('/material/{id}/edit', [TeacherMaterialController::class, 'edit'])->name('teacher.material.edit');
    Route::put('/material/{id}', [TeacherMaterialController::class, 'update'])->name('teacher.material.update');
    Route::delete('/material/{id}', [TeacherMaterialController::class, 'destroy'])->name('teacher.material.destroy');

});

// ... di dalam group prefix 'teacher' ...

// Route Tambah & Hapus Chapter
Route::post('/course/{courseId}/chapter', [TeacherChapterController::class, 'store'])->name('teacher.chapter.store');
Route::delete('/chapter/{id}', [TeacherChapterController::class, 'destroy'])->name('teacher.chapter.destroy');