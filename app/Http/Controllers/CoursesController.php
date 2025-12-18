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
        $courses = collect(); // Siapkan collection kosong agar tidak error jika data null

        // --- SKENARIO 1: JIKA YANG LOGIN ADALAH SISWA ---
        if ($user->role == 'student') {
            // Cek apakah data profile siswa ada?
            if ($user->student) {
                $courses = courses::where('class_id', $user->student->class_id)
                    ->with(['subject', 'teachers.user'])
                    ->get();
            }
        }

        // --- SKENARIO 2: JIKA YANG LOGIN ADALAH GURU ---
        elseif ($user->role == 'teacher') {
            // Cek apakah data profile guru ada?
            if ($user->teacher) {
                // Guru melihat 'My Class' berdasarkan apa yang DIA AJAR
                // Filter berdasarkan 'teacher_id'
                $courses = courses::where('teacher_id', $user->teacher->id)
                    ->with(['subject', 'classRoom']) // Kita butuh data kelas (classRoom) untuk ditampilkan
                    ->get();
            }
        }

        return view('student.my-classes', compact('courses'));
    }

    // Halaman Detail Materi (Isi Pelajaran)
    public function show($id)
    {
        $user = Auth::user();

        // 1. Cari Course terlebih dahulu
        // (Penting: Ambil data dulu baru kita cek siapa yang boleh lihat)
        $courses = courses::with(['chapters.materials', 'teachers.user', 'subject'])
            ->findOrFail($id);

        // 2. LOGIKA KEAMANAN (Cek Hak Akses)
        
        // SKENARIO A: Jika yang akses adalah GURU
        if ($user->role == 'teacher') {
            // Cek apakah data guru ada DAN apakah dia yang mengajar course ini?
            if (!$user->teacher || $courses->teacher_id !== $user->teacher->id) {
                abort(403, 'Akses Ditolak: Anda bukan pengajar mata pelajaran ini.');
            }
        } 
        
        // SKENARIO B: Jika yang akses adalah SISWA
        elseif ($user->role == 'student') {
            // Cek apakah data siswa ada DAN apakah dia satu kelas dengan course ini?
            if (!$user->student || $courses->class_id !== $user->student->class_id) {
                abort(403, 'Maaf, Anda tidak terdaftar di kelas ini.');
            }
        }

        // 3. Jika lolos pengecekan di atas, tampilkan view
        return view('student.courses-detail', compact('courses')); 
    }
}