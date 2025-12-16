<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LmsSeeder extends Seeder
{
    public function run()
    {
        // 1. Buat Tahun Ajaran
        $academicYearId = DB::table('academic_years')->insertGetId([
            'name' => '2024/2025',
            'semester' => 'ganjil',
            'is_active' => true,
            'created_at' => now(), 'updated_at' => now(),
        ]);

        // 2. Buat Kelas
        $classRPL = DB::table('classes')->insertGetId([
            'name' => 'XII RPL 1', 'grade_level' => '12',
            'created_at' => now(), 'updated_at' => now(),
        ]);
        
        $classTKJ = DB::table('classes')->insertGetId([
            'name' => 'X TKJ 2', 'grade_level' => '10',
            'created_at' => now(), 'updated_at' => now(),
        ]);

        // 3. Buat Mata Pelajaran
        $subjectWeb = DB::table('subjects')->insertGetId([
            'name' => 'Pemrograman Web', 'code' => 'WEB-01',
            'description' => 'Belajar Laravel dan React',
            'created_at' => now(), 'updated_at' => now(),
        ]);
        
        $subjectMath = DB::table('subjects')->insertGetId([
            'name' => 'Matematika', 'code' => 'MTK-01',
            'created_at' => now(), 'updated_at' => now(),
        ]);

        // 4. Buat User: GURU
        $userTeacher = DB::table('users')->insertGetId([
            'name' => 'Pak Budi Santoso',
            'email' => 'guru@sekolah.com',
            'password' => Hash::make('password'),
            'role' => 'teacher',
            'created_at' => now(), 'updated_at' => now(),
        ]);
        // Detail Guru
        $teacherId = DB::table('teachers')->insertGetId([
            'user_id' => $userTeacher,
            'nip' => '198501012010011001',
            'created_at' => now(), 'updated_at' => now(),
        ]);

        // 5. Buat User: SISWA (2 Orang)
        // Siswa A (RPL)
        $userStudentA = DB::table('users')->insertGetId([
            'name' => 'Ahmad Siswa',
            'email' => 'ahmad@sekolah.com',
            'password' => Hash::make('password'),
            'role' => 'student',
            'created_at' => now(), 'updated_at' => now(),
        ]);
        $studentAId = DB::table('students')->insertGetId([
            'user_id' => $userStudentA,
            'class_id' => $classRPL, // Masuk XII RPL 1
            'nis' => '1001',
            'created_at' => now(), 'updated_at' => now(),
        ]);

        // Siswa B (TKJ)
        $userStudentB = DB::table('users')->insertGetId([
            'name' => 'Budi Siswa',
            'email' => 'budi@sekolah.com',
            'password' => Hash::make('password'),
            'role' => 'student',
            'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('students')->insert([
            'user_id' => $userStudentB,
            'class_id' => $classTKJ, // Masuk X TKJ 2
            'nis' => '1002',
            'created_at' => now(), 'updated_at' => now(),
        ]);

        // 6. Buat Course (Kelas Belajar)
        // Pak Budi mengajar Web di XII RPL 1
        $courseId = DB::table('courses')->insertGetId([
            'teacher_id' => $teacherId,
            'subject_id' => $subjectWeb,
            'class_id'   => $classRPL,
            'academic_year_id' => $academicYearId,
            'description' => 'Kelas Pemrograman Web Lanjut',
            'created_at' => now(), 'updated_at' => now(),
        ]);

        // 7. Buat Chapter & Materi
        $chapterId = DB::table('chapters')->insertGetId([
            'course_id' => $courseId,
            'title' => 'Pertemuan 1: Instalasi Laravel',
            'created_at' => now(), 'updated_at' => now(),
        ]);

        DB::table('materials')->insert([
            'chapter_id' => $chapterId,
            'title' => 'Video Tutorial Instalasi',
            'type' => 'link',
            'content' => 'https://youtube.com/watch?v=kodenya',
            'is_published' => true,
            'created_at' => now(), 'updated_at' => now(),
        ]);

        DB::table('materials')->insert([
            'chapter_id' => $chapterId,
            'title' => 'Modul PDF Dasar Laravel',
            'type' => 'pdf',
            'file_path' => 'materials/modul-dasar.pdf',
            'is_published' => true,
            'created_at' => now(), 'updated_at' => now(),
        ]);

        // 8. Buat Tugas & Submission
        $assignmentId = DB::table('assignments')->insertGetId([
            'course_id' => $courseId,
            'title' => 'Tugas Membuat Halaman Login',
            'description' => 'Buat halaman login sederhana dengan Laravel Breeze.',
            'deadline' => Carbon::now()->addDays(7),
            'created_at' => now(), 'updated_at' => now(),
        ]);

        // Siswa Ahmad mengumpulkan tugas
        DB::table('submissions')->insert([
            'assignment_id' => $assignmentId,
            'student_id' => $studentAId,
            'file_path' => 'submissions/tugas-ahmad.zip',
            'note' => 'Sudah selesai pak, mohon dicek.',
            'grade' => 85,
            'teacher_feedback' => 'Bagus, tapi validasi password kurang kuat.',
            'submitted_at' => now(),
            'created_at' => now(), 'updated_at' => now(),
        ]);
    }
}