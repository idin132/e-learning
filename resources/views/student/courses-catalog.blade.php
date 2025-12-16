@extends('layouts.main')

@section('content')
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">All Courses</h1>
        <p class="text-gray-500 mt-1">Explore courses available at our school.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($courses as $course)
            {{-- LOGIKA UTAMA: Cek Kelas --}}
            @php
                // Ambil ID kelas siswa yang sedang login
                $studentClassId = auth()->user()->student->class_id;
                
                // Cek apakah course ini milik kelas siswa tersebut
                $isMyClass = ($course->class_id == $studentClassId);
            @endphp

            <div class="bg-white rounded-2xl shadow-sm hover:shadow-md transition-shadow p-4 border border-gray-100 flex flex-col h-full">
                <div class="h-40 rounded-xl bg-gray-200 overflow-hidden mb-4 relative">
                    <img src="{{ $course->thumbnail ? asset('storage/'.$course->thumbnail) : 'https://source.unsplash.com/random/600x400?education&sig='.$course->id }}" 
                         class="w-full h-full object-cover">
                    
                    {{-- Badge Kategori (Opsional) --}}
                    <span class="absolute top-3 left-3 px-2 py-1 rounded text-xs font-bold text-white {{ $isMyClass ? 'bg-blue-600' : 'bg-gray-600' }}">
                        {{ $course->subject->code }}
                    </span>
                </div>
                
                <div class="mb-2">
                    <h3 class="text-lg font-bold text-gray-800 mb-1 leading-tight">{{ $course->subject->name }}</h3>
                    <p class="text-sm text-gray-500">{{ $course->teacher->user->name ?? 'Instructor' }}</p>
                    {{-- Tampilkan nama kelas agar jelas --}}
                    <p class="text-xs text-gray-400 mt-1">Class: {{ $course->classRoom->name ?? '-' }}</p>
                </div>

                <div class="mt-auto pt-4">
                    @if($isMyClass)
                        {{-- JIKA KELAS SAYA: Tombol Continue Learning --}}
                        <a href="{{ route('course.show', $course->id) }}" 
                           class="block w-full text-center py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg transition-colors">
                            Continue Learning
                        </a>
                    @else
                        {{-- JIKA BUKAN KELAS SAYA: Tombol Enroll Now (Dikunci) --}}
                        {{-- Kamu bisa arahkan ke route enroll nanti --}}
                        <button onclick="alert('Anda harus mendaftar untuk mengakses kelas ini!')" 
                                class="block w-full text-center py-2.5 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold rounded-lg transition-colors">
                            Enroll Now
                        </button>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection