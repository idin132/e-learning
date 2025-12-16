<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\courses;
use App\Models\classes;
use Illuminate\Support\Facades\Auth;

class ClassesController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Cek apakah user adalah siswa
        if ($user->role !== 'student') {
            abort(403, 'Hanya siswa yang bisa mengakses halaman ini.');
        }
        // 1. Ambil data siswa dari user yg login
        $student = $user->student;

        // 2. Ambil courses berdasarkan kelas siswa tersebut
        // Kita gunakan 'with' untuk Eager Loading (biar query cepat)
        $courses = courses::where('class_id', $student->class_id)
            ->with(['subject', 'teachers.user'])
            ->get();

        return view('student.my-classes', compact('courses'));

    }
}
