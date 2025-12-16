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

    @forelse($courses->chapters as $index => $chapter)
        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                <h3 class="font-bold text-gray-800">Chapter {{ $index + 1 }}: {{ $chapter->title }}</h3>
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
                                    {{ $material->title }}</h4>
                                <p class="text-xs text-gray-400 capitalize">{{ $material->type }}</p>
                            </div>
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