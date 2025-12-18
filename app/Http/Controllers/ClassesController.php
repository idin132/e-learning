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
        $courses = collect(); // Siapkan array kosong agar tidak error jika data null

        // --- SKENARIO 1: JIKA YANG LOGIN ADALAH SISWA ---
        if ($user->role == 'student') {
            // Cek apakah data profile siswa ada? (Menghindari error on null)
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
                // Guru melihat daftar pelajaran yang DIA AJAR
                // Filter berdasarkan 'teacher_id' milik guru tersebut
                $courses = courses::where('teacher_id', $user->teacher->id)
                    ->with(['subject', 'classRoom']) // Load relasi kelas untuk ditampilkan namanya
                    ->get();
            }
        }

        return view('student.my-classes', compact('courses'));
    }
}
