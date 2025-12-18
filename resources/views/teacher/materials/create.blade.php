@extends('layouts.main')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Tambah Materi Baru</h1>
        <p class="text-gray-500">Bab: {{ $chapter->title }}</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <form action="{{ route('teacher.material.store', $chapter->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Judul Materi</label>
                <input type="text" name="title" required class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Tipe Materi</label>
                <select name="type" id="typeSelector" class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    <option value="pdf">Dokumen PDF</option>
                    <option value="video">Video Upload</option>
                    <option value="link">Link Eksternal (YouTube/Zoom)</option>
                    <option value="text">Teks Bacaan</option>
                </select>
            </div>

            <div id="fileInput" class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Upload File</label>
                <input type="file" name="file" class="w-full px-4 py-2 border rounded-lg">
                <p class="text-xs text-gray-500 mt-1">Format: PDF atau MP4 (Max 10MB)</p>
            </div>

            <div id="linkInput" class="mb-4 hidden">
                <label class="block text-sm font-medium text-gray-700 mb-1">Link URL</label>
                <input type="url" name="link" placeholder="https://youtube.com/..." class="w-full px-4 py-2 border rounded-lg">
            </div>

            <div id="textInput" class="mb-4 hidden">
                <label class="block text-sm font-medium text-gray-700 mb-1">Isi Materi</label>
                <textarea name="content" rows="5" class="w-full px-4 py-2 border rounded-lg"></textarea>
            </div>

            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium">
                Simpan Materi
            </button>
        </form>
    </div>
</div>

<script>
    // Script sederhana untuk ganti input field
    const typeSelector = document.getElementById('typeSelector');
    const fileInput = document.getElementById('fileInput');
    const linkInput = document.getElementById('linkInput');
    const textInput = document.getElementById('textInput');

    typeSelector.addEventListener('change', function() {
        // Sembunyikan semua dulu
        fileInput.classList.add('hidden');
        linkInput.classList.add('hidden');
        textInput.classList.add('hidden');

        // Tampilkan sesuai pilihan
        if (this.value === 'pdf' || this.value === 'video') {
            fileInput.classList.remove('hidden');
        } else if (this.value === 'link') {
            linkInput.classList.remove('hidden');
        } else if (this.value === 'text') {
            textInput.classList.remove('hidden');
        }
    });
</script>
@endsection