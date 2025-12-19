@extends('layouts.main')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800">All Courses</h1>
    <p class="text-gray-500 mt-1">Explore courses available at our school.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($courses as $course)
        @php
            $user = auth()->user();
            $canAccess = false; // Default: Tidak bisa akses (Harus Enroll)
            $buttonText = 'Enroll Now';
            $buttonClass = 'bg-green-600 hover:bg-green-700';
            $link = '#';
            $onclick = "alert('Anda Tidak Bisa Mengakses Course Ini!');";

            // --- LOGIKA CEK AKSES ---

            // 1. Jika User adalah SISWA
            if ($user->role == 'student' && $user->student) {
                // Cek: Apakah kelas course ini SAMA dengan kelas siswa?
                if ($course->class_id == $user->student->class_id) {
                    $canAccess = true;
                    $buttonText = 'Continue Learning';
                    $buttonClass = 'bg-blue-600 hover:bg-blue-700';
                    $link = route('course.show', $course->id);
                    $onclick = ''; // Hapus alert
                }
            }

            // 2. Jika User adalah GURU
            elseif ($user->role == 'teacher' && $user->teacher) {
                // Cek: Apakah guru ini yang mengajar course ini?
                if ($course->teacher_id == $user->teacher->id) {
                    $canAccess = true;
                    $buttonText = 'Manage Materials'; // Beda teks untuk guru
                    $buttonClass = 'bg-purple-600 hover:bg-purple-700';
                    $link = route('course.show', $course->id);
                    $onclick = '';
                }
            }
        @endphp

        <div
            class="bg-white rounded-2xl shadow-sm hover:shadow-md transition-shadow p-4 border border-gray-100 flex flex-col h-full">
            <div class="h-40 rounded-xl bg-gray-200 overflow-hidden mb-4 relative">
                <img src="{{ $course->thumbnail ? asset('storage/' . $course->thumbnail) : 'https://source.unsplash.com/random/600x400?education,tech&sig=' . $course->id }}"
                    class="w-full h-full object-cover">

                {{-- Badge Nama Kelas --}}
                <span
                    class="absolute top-3 left-3 px-2 py-1 rounded text-xs font-bold text-white bg-black/50 backdrop-blur-sm">
                    {{ $course->classRoom->name ?? 'Unknown Class' }}
                </span>
            </div>

            <div class="mb-2">
                <h3 class="text-lg font-bold text-gray-800 mb-1 leading-tight">{{ $course->subject->name }}</h3>
                <p class="text-sm text-gray-500">{{ $course->teachers->user->name ?? 'No Teacher' }}</p>
            </div>

            <div class="mt-auto pt-4">
                @if($canAccess)
                    {{-- TOMBOL AKSES (Siswa/Guru yang berhak) --}}
                    <a href="{{ $link }}"
                        class="block w-full text-center py-2.5 {{ $buttonClass }} text-white text-sm font-semibold rounded-lg transition-colors">
                        {{ $buttonText }}
                    </a>
                @else
                    {{-- TOMBOL ENROLL (Untuk user asing) --}}
                    <button onclick="{{ $onclick }}"
                        class="block w-full text-center py-2.5 {{ $buttonClass }} text-white text-sm font-semibold rounded-lg transition-colors">
                        {{ $buttonText }}
                    </button>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection