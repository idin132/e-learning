<?php

namespace App\Http\Controllers;

use App\Models\chapters;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\courses;
use App\Models\students; // Pastikan model students di-import
use App\Models\User;

// class DashboardController extends Controller
// {
//     public function index()
//     {
//         $user = Auth::user();

//         if ($user->role == 'teacher') {
//             // Data Mockup untuk Guru (Nanti diganti query database asli)
//             return view('dashboard', [
//                 'total_students' => 120,
//                 'total_courses' => 4,
//                 'pending_grading' => 15,
//                 'recent_submissions' => [
//                     ['name' => 'Ahmad Santoso', 'task' => 'Laravel Installation', 'date' => '2 mins ago'],
//                     ['name' => 'Budi Pratama', 'task' => 'Database Migration', 'date' => '1 hour ago'],
//                     ['name' => 'Siti Aminah', 'task' => 'React Components', 'date' => '3 hours ago'],
//                 ]
//             ]);
//         } else {
//             // Data Mockup untuk Siswa
//             return view('dashboard', [
//                 'courses_in_progress' => 3,
//                 'completed_courses' => 12,
//                 'average_grade' => 88,
//                 'upcoming_tasks' => [
//                     ['task' => 'Submit UI Design', 'course' => 'UI/UX Fundamentals', 'due' => 'Tomorrow'],
//                     ['task' => 'Database Quiz', 'course' => 'MySQL Mastery', 'due' => '3 Days Left'],
//                 ]
//             ]);
//         }
//     }
// }

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // ===========================
        // LOGIKA DASHBOARD GURU
        // ===========================
        if ($user->role == 'teacher') {

            // Cek apakah data profile teacher lengkap
            if (!$user->teacher) {
                return view('dashboard', [
                    'total_students' => 0,
                    'total_courses' => 0,
                    'total_chapters' => 0,
                    'pending_grading' => 0,
                    'recent_submissions' => []
                ]);
            }

            $teacherId = $user->teacher->id;

            // 1. HITUNG TOTAL COURSES (Jadwal Mengajar)
            // Menghitung berapa banyak pelajaran yang diajar oleh guru ini
            $totalCourses = courses::where('teacher_id', $teacherId)->count();
            $totalChapters = chapters::count('id');
            // 2. HITUNG TOTAL STUDENTS (Jumlah Siswa yang Diajar)
            // Logikanya: 

            $classIds = courses::where('teacher_id', $teacherId)->pluck('class_id');
            $totalStudents = students::whereIn('class_id', $classIds)->count();

            // Kirim data ke View
            return view('dashboard', [
                'total_students' => $totalStudents, // Data Asli Database
                'total_courses' => $totalCourses,   // Data Asli Database
                'total_chapters' => $totalChapters, // Data Asli Database

                // Data di bawah ini masih Mockup (karena tabel tugas/submission belum kita buat)
                'pending_grading' => 0,
                'recent_submissions' => []
            ]);
        }

        // ===========================
        // LOGIKA DASHBOARD SISWA
        // ===========================
        else {

            // Cek data profile student
            if (!$user->student) {
                return view('dashboard', [
                    'courses_in_progress' => 0,
                    'completed_courses' => 0,
                    'average_grade' => 0,
                    'upcoming_tasks' => []
                ]);
            }

            // 1. HITUNG COURSE (MY CLASSES)
            // Menghitung berapa mapel yang wajib diikuti siswa sesuai kelasnya
            $coursesInProgress = courses::where('class_id', $user->student->class_id)->count();

            return view('dashboard', [
                'courses_in_progress' => $coursesInProgress, // Data Asli Database

                // Data di bawah ini masih Mockup (butuh tabel progress & nilai)
                'completed_courses' => 0,
                'average_grade' => 0,
                'upcoming_tasks' => []
            ]);
        }
    }
}