@extends('layouts.main')

@section('content')
<a href="{{ route('my-classes') }}"
    class="inline-flex items-center text-gray-500 hover:text-blue-600 mb-6 transition-colors">
    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
    </svg>
    Back to Classes
</a>

<div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm mb-8 flex flex-col md:flex-row gap-6 items-start">
    <div class="w-full md:w-64 h-40 bg-gray-200 rounded-xl overflow-hidden shrink-0">
        <img src="{{ $courses->thumbnail ? asset('storage/' . $courses->thumbnail) : 'https://source.unsplash.com/random/600x400?education,tech&sig=' . $courses->id }}"
            class="w-full h-full object-cover">
    </div>
    <div>
        <span class="bg-blue-50 text-blue-600 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">
            {{ $courses->subject->code ?? 'COURSE' }}
        </span>
        <h1 class="text-3xl font-bold text-gray-800 mt-3 mb-2">{{ $courses->subject->name }}</h1>
        <p class="text-gray-500">{{ $courses->description ?? 'Tidak ada deskripsi untuk mata pelajaran ini.' }}</p>
        <div class="flex items-center gap-3 mt-4">
            <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-xs font-bold">
                {{-- Cek apakah teacher ada --}}
                @if($courses->teacher && $courses->teacher->user)
                    {{ strtoupper(substr($courses->teacher->user->name, 0, 2)) }}
                @else
                    ?? {{-- Tampilkan tanda tanya jika guru tidak ada --}}
                @endif
            </div>
            <span class="text-sm font-medium text-gray-700">
                {{ $courses->teacher?->user?->name ?? 'Guru Tidak Dikenal' }}
            </span>
        </div>
    </div>
</div>

<div class="space-y-4">
    <h2 class="text-xl font-bold text-gray-800 mb-4">Course Content</h2>
    @if(auth()->user()->role == 'teacher' && $courses->teacher_id == auth()->user()->teacher->id)

        <div class="mb-6 bg-blue-50 p-4 rounded-xl border border-blue-100">
            <h3 class="font-bold text-blue-800 mb-2">Kelola Bab Pembelajaran</h3>

            <form action="{{ route('teacher.chapter.store', $courses->id) }}" method="POST" class="flex gap-2">
                @csrf
                <input type="text" name="title" required placeholder="Contoh: Bab 1 - Pengenalan Dasar"
                    class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">

                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors">
                    + Tambah Bab
                </button>
            </form>
        </div>

    @endif

    @forelse($courses->chapters as $index => $chapter)
        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-100 flex justify-between items-center">

                <!-- <h3 class="font-bold text-gray-800">Chapter {{ $index + 1 }}: {{ $chapter->title }}</h3> -->

                <div class="bg-gray-50 px-6 py-4 border-b border-gray-100 flex justify-between items-center">

                    <h3 class="font-bold text-gray-800">Chapter {{ $index + 1 }}: {{ $chapter->title }}</h3>

                    <div class="flex items-center gap-2">
                        @if(auth()->user()->role == 'teacher' && $courses->teacher_id == auth()->user()->teacher->id)

                            <form action="{{ route('teacher.chapter.destroy', $chapter->id) }}" method="POST"
                                onsubmit="return confirm('Hapus Bab ini beserta isinya?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 p-1" title="Hapus Bab">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        @endif
                    </div>
                </div>

                @if(auth()->user()->role == 'teacher' && $courses->teacher_id == auth()->user()->teacher->id)
                    <a href="{{ route('teacher.material.create', $chapter->id) }}"
                        class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-600 text-white text-xs font-semibold rounded-lg hover:bg-blue-700 transition-colors">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Materi
                    </a>
                @endif

            </div>

            <div class="p-2">
                @foreach($chapter->materials as $material)
                    <div
                        class="flex items-center justify-between p-3 hover:bg-blue-50 rounded-lg transition-colors group cursor-pointer">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-10 h-10 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center shrink-0">
                                @if($material->type == 'video')
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                @elseif($material->type == 'pdf')
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                @else
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                    </svg>
                                @endif
                            </div>
                            <div>
                                <h4 class="text-sm font-semibold text-gray-800 group-hover:text-blue-600 transition-colors">
                                    {{ $material->title }}
                                </h4>
                                <p class="text-xs text-gray-400 capitalize">{{ $material->type }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <a href="..." class="...">Buka</a>

                            {{-- FITUR GURU: Tombol Edit & Delete --}}
                            @if(auth()->user()->role == 'teacher' && $courses->teacher_id == auth()->user()->teacher->id)

                                <a href="{{ route('teacher.material.edit', $material->id) }}"
                                    class="p-2 text-yellow-500 hover:bg-yellow-50 rounded">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </a>

                                <form action="{{ route('teacher.material.destroy', $material->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin hapus materi ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>

                            @endif
                        </div>

                        <a href="{{ $material->type == 'link' ? $material->content : asset('storage/' . $material->file_path) }}"
                            target="_blank"
                            class="px-4 py-2 text-xs font-semibold text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-600 hover:text-white transition-colors">
                            {{ $material->type == 'link' ? 'Open Link' : 'Download' }}
                        </a>
                    </div>
                @endforeach

                @if($chapter->materials->isEmpty())
                    <div class="p-4 text-center text-sm text-gray-400 italic">
                        Belum ada materi di bab ini.
                    </div>
                @endif
            </div>
        </div>
    @empty
        <div class="p-8 bg-white rounded-2xl border border-gray-100 text-center">
            <p class="text-gray-500">Belum ada Bab/Materi yang diupload guru untuk pelajaran ini.</p>
        </div>
    @endforelse
</div>
@endsection