@extends('layouts.main')

@section('content')
<div class="max-w-3xl mx-auto">
    <a href="{{ route('course.show', $material->chapter->course->id) }}" class="inline-flex items-center text-gray-500 hover:text-blue-600 mb-6 transition-colors">
        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
        Kembali ke Materi
    </a>

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit Materi</h1>
        <p class="text-gray-500">Mengubah materi pada bab: {{ $material->chapter->title }}</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <form action="{{ route('teacher.material.update', $material->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') {{-- PENTING: Method PUT untuk Update --}}

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Judul Materi</label>
                <input type="text" name="title" value="{{ old('title', $material->title) }}" required 
                       class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Tipe Materi</label>
                <select name="type" id="typeSelector" class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    <option value="pdf" {{ $material->type == 'pdf' ? 'selected' : '' }}>Dokumen PDF</option>
                    <option value="video" {{ $material->type == 'video' ? 'selected' : '' }}>Video Upload</option>
                    <option value="link" {{ $material->type == 'link' ? 'selected' : '' }}>Link Eksternal (YouTube/Zoom)</option>
                    <option value="text" {{ $material->type == 'text' ? 'selected' : '' }}>Teks Bacaan</option>
                </select>
            </div>

            <div id="fileInput" class="mb-4 {{ in_array($material->type, ['pdf', 'video']) ? '' : 'hidden' }}">
                <label class="block text-sm font-medium text-gray-700 mb-1">Upload File Baru (Opsional)</label>
                
                @if($material->file_path)
                    <div class="mb-2 text-sm text-blue-600 bg-blue-50 p-2 rounded inline-block">
                        File saat ini: <a href="{{ asset('storage/' . $material->file_path) }}" target="_blank" class="underline hover:text-blue-800">Lihat File</a>
                    </div>
                @endif

                <input type="file" name="file" class="w-full px-4 py-2 border rounded-lg">
                <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengganti file.</p>
            </div>

            <div id="linkInput" class="mb-4 {{ $material->type == 'link' ? '' : 'hidden' }}">
                <label class="block text-sm font-medium text-gray-700 mb-1">Link URL</label>
                <input type="url" name="link" 
                       value="{{ $material->type == 'link' ? $material->content : '' }}"
                       placeholder="https://youtube.com/..." class="w-full px-4 py-2 border rounded-lg">
            </div>

            <div id="textInput" class="mb-4 {{ $material->type == 'text' ? '' : 'hidden' }}">
                <label class="block text-sm font-medium text-gray-700 mb-1">Isi Materi</label>
                <textarea name="content" rows="5" class="w-full px-4 py-2 border rounded-lg">{{ $material->type == 'text' ? $material->content : '' }}</textarea>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium">
                    Simpan Perubahan
                </button>
                <a href="{{ route('course.show', $material->chapter->course->id) }}" class="px-6 py-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 font-medium">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    const typeSelector = document.getElementById('typeSelector');
    const fileInput = document.getElementById('fileInput');
    const linkInput = document.getElementById('linkInput');
    const textInput = document.getElementById('textInput');

    function toggleInputs(type) {
        // Sembunyikan semua
        fileInput.classList.add('hidden');
        linkInput.classList.add('hidden');
        textInput.classList.add('hidden');

        // Tampilkan yang dipilih
        if (type === 'pdf' || type === 'video') {
            fileInput.classList.remove('hidden');
        } else if (type === 'link') {
            linkInput.classList.remove('hidden');
        } else if (type === 'text') {
            textInput.classList.remove('hidden');
        }
    }

    // Jalankan saat dropdown berubah
    typeSelector.addEventListener('change', function() {
        toggleInputs(this.value);
    });

    // Jalankan saat halaman pertama kali dimuat (untuk set posisi awal sesuai database)
    // Tidak perlu manual call karena class 'hidden' sudah di-set via Blade logic di atas,
    // tapi function ini berguna jika user refresh page dan browser menyimpan state dropdown.
    toggleInputs(typeSelector.value);
</script>
@endsection