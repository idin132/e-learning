<?php

namespace App\Http\Controllers;

// GANTI 2 BARIS INI:
use App\Models\chapters;  // Sebelumnya: use App\Models\Chapter;
use App\Models\materials; // Sebelumnya: use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class TeacherMaterialController extends Controller
{
    public function create($chapterId)
    {
        // Ganti Chapter:: jadi chapters::
        $chapter = chapters::with('course')->findOrFail($chapterId);

        // KEAMANAN: Cek apakah guru yang login adalah pemilik kelas ini
        if ($chapter->course->teacher_id !== Auth::user()->teacher->id) {
            abort(403, 'Anda tidak berhak menambahkan materi di kelas ini.');
        }

        return view('teacher.materials.create', compact('chapter'));
    }

    // public function store(Request $request, $chapterId)
    // {
    //     // --- DEBUGGING ---
    //     // Hapus baris ini nanti jika sudah berhasil
    //     // dd($request->all()); 
    //     // -----------------

    //     $request->validate([
    //         'title' => 'required|string|max:255',
    //         'type' => 'required|in:pdf,video,link,text',
    //         // Koreksi validasi file: pastikan 'max' dalam Kilobytes (10MB = 10240KB)
    //         'file' => 'required_if:type,pdf,video|file|max:10240',
    //         'link' => 'required_if:type,link|active_url', // Gunakan active_url atau url
    //         'content' => 'required_if:type,text|string|nullable',
    //     ]);

    //     $filePath = null;
    //     $content = $request->content;

    //     // Upload File jika ada
    //     if ($request->hasFile('file')) {
    //         $filePath = $request->file('file')->store('materials', 'public');
    //     }
    //     // Simpan Link di kolom content jika tipe link
    //     if ($request->type == 'link') {
    //         $content = $request->link;
    //     }

    //     // Ganti Material::create jadi materials::create
    //     materials::create([
    //         'chapter_id' => $chapterId,
    //         'title' => $request->title,
    //         'type' => $request->type,
    //         'file_path' => $filePath,
    //         'content' => $content,
    //         'is_published' => true,
    //         // ...
    //     ]);

    //     return redirect()->back()->with('success', 'Materi berhasil ditambahkan!');
    // }

    public function store(Request $request, $chapterId)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:pdf,video,link,text',

            // TAMBAHKAN 'nullable' DI SINI
            // Artinya: Wajib diisi JIKA type-nya pdf/video. Tapi kalau kosong (nullable), loloskan saja (jangan cek max/file).
            'file' => 'required_if:type,pdf,video|nullable|file|max:10240',

            // TAMBAHKAN 'nullable' JUGA DI SINI
            // Artinya: Wajib JIKA type-nya link. Kalau kosong (nullable), jangan paksa cek format URL.
            'link' => 'required_if:type,link|nullable|url',

            // INI JUGA
            'content' => 'required_if:type,text|nullable|string',
        ]);

        // ... (kode simpan ke database di bawahnya tetap sama) ...

        $filePath = null;
        $content = $request->content;

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('materials', 'public');
        }

        if ($request->type == 'link') {
            $content = $request->link;
        }

        // Pastikan pakai model materials (huruf kecil sesuai model kamu)
        materials::create([
            'chapter_id' => $chapterId,
            'title' => $request->title,
            'type' => $request->type,
            'file_path' => $filePath,
            'content' => $content,
            'is_published' => true,
        ]);

        $chapter = \App\Models\chapters::findOrFail($chapterId);
        return redirect()->route('course.show', $chapter->course_id)->with('success', 'Materi berhasil ditambahkan!');
    }

    public function edit($id)
    {
        // Ganti Material:: jadi materials::
        $material = materials::with('chapter.course')->findOrFail($id);

        // KEAMANAN
        if ($material->chapter->course->teacher_id !== Auth::user()->teacher->id) {
            abort(403);
        }

        return view('teacher.materials.edit', compact('material'));
    }

    public function update(Request $request, $id)
    {
        $material = materials::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:pdf,video,link,text',
        ]);

        $data = [
            'title' => $request->title,
            'type' => $request->type,
        ];

        // Cek jika ada upload file baru
        if ($request->hasFile('file')) {
            // Hapus file lama
            if ($material->file_path) {
                Storage::disk('public')->delete($material->file_path);
            }
            $data['file_path'] = $request->file('file')->store('materials', 'public');
        }

        if ($request->type == 'link') {
            $data['content'] = $request->link;
        } elseif ($request->type == 'text') {
            $data['content'] = $request->content;
        }

        $material->update($data);

        return redirect()->back()->with('success', 'Materi berhasil diperbarui!');
    }

    // Proses Hapus Materi
    public function destroy($id)
    {
        $material = materials::with('chapter.course')->findOrFail($id);

        // KEAMANAN
        if ($material->chapter->course->teacher_id !== Auth::user()->teacher->id) {
            abort(403);
        }

        // Hapus file fisik jika ada
        if ($material->file_path) {
            Storage::disk('public')->delete($material->file_path);
        }

        $material->delete();

        return redirect()->back()->with('success', 'Materi berhasil dihapus.');
    }
}