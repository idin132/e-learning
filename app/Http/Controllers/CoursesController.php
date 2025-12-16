<?php

namespace App\Http\Controllers;

use App\Models\courses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoursesController extends Controller
{
    // Halaman "My Classes"
    public function index()
    {
        $user = Auth::user();
        $courses = courses::all();
        return view('student.courses-catalog', compact('courses'));
    }

    // Halaman Detail Materi (Isi Pelajaran)
    public function show($id)
    {
        $user = Auth::user();
        $studentClassId = $user->student->class_id;

        // 1. Cari Course
        $courses = courses::with(['chapters.materials', 'teachers.user', 'subject'])
            ->findOrFail($id);

        // 2. KEAMANAN: Cek apakah course ini untuk kelas siswa tersebut?
        // Jika BUKAN kelasnya, tolak akses (403 Forbidden)
        if ($courses->class_id !== $studentClassId) {
            // Nanti di sini kamu bisa tambah logika cek tabel pivot jika sudah fitur Enroll beneran
            abort(403, 'Maaf, Anda tidak terdaftar di kelas ini. Silakan Enroll terlebih dahulu.');
        }

        return view('student.courses-detail', compact('courses')); // variable disesuaikan jadi singular $course
    }
}