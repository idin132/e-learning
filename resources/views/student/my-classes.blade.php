@extends('layouts.main')

@section('content')
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">My Classes</h1>
        <p class="text-gray-500 mt-1">
            Class: <span class="font-semibold text-blue-600">{{ auth()->user()->student->classRoom->name ?? 'Belum ada kelas' }}</span>
        </p>
    </div>

    @if($courses->isEmpty())
        <div class="p-6 bg-yellow-50 text-yellow-700 rounded-xl">
            Belum ada mata pelajaran yang dijadwalkan untuk kelas kamu.
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            
            @foreach($courses as $course)
            <div class="bg-white rounded-2xl shadow-sm hover:shadow-md transition-shadow p-4 border border-gray-100 flex flex-col h-full">
                <div class="h-40 rounded-xl bg-gray-200 overflow-hidden mb-4 relative">
                    {{-- Jika ada gambar di database pakai itu, jika tidak pakai random image --}}
                    <img src="{{ $course->thumbnail ? asset('storage/'.$course->thumbnail) : 'https://source.unsplash.com/random/600x400?education,tech&sig='.$course->id }}" 
                         class="w-full h-full object-cover" alt="Course Image">
                </div>
                
                <div class="mb-2">
                    <h3 class="text-lg font-bold text-gray-800 mb-1 leading-tight">{{ $course->subject->name }}</h3>
                    <p class="text-sm text-gray-500">{{ $course->teacher->user->name ?? 'Guru Tidak Dikenal' }}</p>
                </div>

                <div class="flex items-center gap-4 text-xs text-gray-400 mb-4 mt-auto">
                    <div class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                        {{-- Hitung jumlah materi (opsional) --}}
                        <span>{{ $course->chapters_count ?? 0 }} Chapters</span>
                    </div>
                </div>

                <a href="{{ route('course.show', $course->id) }}" 
                   class="block w-full text-center py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg transition-colors">
                    Continue Learning
                </a>
            </div>
            @endforeach

        </div>
    @endif
@endsection