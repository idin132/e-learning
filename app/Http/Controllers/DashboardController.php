<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role == 'teacher') {
            // Data Mockup untuk Guru (Nanti diganti query database asli)
            return view('dashboard', [
                'total_students' => 120,
                'total_courses' => 4,
                'pending_grading' => 15,
                'recent_submissions' => [
                    ['name' => 'Ahmad Santoso', 'task' => 'Laravel Installation', 'date' => '2 mins ago'],
                    ['name' => 'Budi Pratama', 'task' => 'Database Migration', 'date' => '1 hour ago'],
                    ['name' => 'Siti Aminah', 'task' => 'React Components', 'date' => '3 hours ago'],
                ]
            ]);
        } else {
            // Data Mockup untuk Siswa
            return view('dashboard', [
                'courses_in_progress' => 3,
                'completed_courses' => 12,
                'average_grade' => 88,
                'upcoming_tasks' => [
                    ['task' => 'Submit UI Design', 'course' => 'UI/UX Fundamentals', 'due' => 'Tomorrow'],
                    ['task' => 'Database Quiz', 'course' => 'MySQL Mastery', 'due' => '3 Days Left'],
                ]
            ]);
        }
    }
}