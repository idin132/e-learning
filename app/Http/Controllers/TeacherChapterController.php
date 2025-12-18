<?php

namespace App\Http\Controllers;

use App\Models\chapters;
use App\Models\courses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherChapterController extends Controller
{
    // Proses Simpan Bab Baru
    public function store(Request $request, $courseId)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $course = courses::findOrFail($courseId);

        // Keamanan: Cek apakah guru ini pemilik course
        if ($course->teacher_id !== Auth::user()->teacher->id) {
            abort(403);
        }

        chapters::create([
            'course_id' => $courseId,
            'title' => $request->title,
        ]);

        return redirect()->back()->with('success', 'Bab berhasil ditambahkan!');
    }

    // Proses Hapus Bab
    public function destroy($id)
    {
        $chapter = chapters::with('course')->findOrFail($id);

        // Keamanan
        if ($chapter->course->teacher_id !== Auth::user()->teacher->id) {
            abort(403);
        }

        $chapter->delete(); // Materi di dalamnya akan ikut terhapus jika settingan database cascade (atau perlu dihapus manual)

        return redirect()->back()->with('success', 'Bab berhasil dihapus.');
    }
}