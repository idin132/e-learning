@extends('layouts.main')

@php
    $user = auth()->user();
@endphp

@section('content')
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
            <p class="text-gray-500 mt-1">Welcome back, <span class="font-semibold text-blue-600">{{ $user->name }}</span>! 👋</p>
        </div>
        <div class="text-sm text-gray-500 bg-white px-4 py-2 rounded-lg border border-gray-100 shadow-sm">
            {{ now()->format('l, d F Y') }}
        </div>
    </div>

    {{-- =========================== --}}
    {{-- TAMPILAN KHUSUS GURU (TEACHER) --}}
    {{-- =========================== --}}
    @if($user->role == 'teacher')
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total Students</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $total_students }}</h3>
                </div>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Active Courses</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $total_courses }}</h3>
                </div>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-orange-50 text-orange-600 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Needs Grading</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $pending_grading }}</h3>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <h2 class="text-lg font-bold text-gray-800 mb-4">Recent Submissions</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-gray-400 text-sm border-b border-gray-100">
                            <th class="pb-3 font-medium">Student Name</th>
                            <th class="pb-3 font-medium">Task</th>
                            <th class="pb-3 font-medium">Submitted</th>
                            <th class="pb-3 font-medium text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @foreach($recent_submissions as $sub)
                        <tr class="group hover:bg-gray-50 transition-colors">
                            <td class="py-4 font-medium text-gray-800">{{ $sub['name'] }}</td>
                            <td class="py-4 text-gray-500">{{ $sub['task'] }}</td>
                            <td class="py-4 text-gray-500">{{ $sub['date'] }}</td>
                            <td class="py-4 text-right">
                                <button class="px-3 py-1.5 bg-blue-50 text-blue-600 rounded-lg text-xs font-semibold hover:bg-blue-600 hover:text-white transition-colors">
                                    Grade Now
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


    {{-- =========================== --}}
    {{-- TAMPILAN KHUSUS SISWA (STUDENT) --}}
    {{-- =========================== --}}
    @else

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-blue-600 p-6 rounded-2xl shadow-lg shadow-blue-500/20 text-white relative overflow-hidden">
                <div class="relative z-10">
                    <p class="text-blue-100 text-sm">Courses in Progress</p>
                    <h3 class="text-3xl font-bold mt-1">{{ $courses_in_progress }}</h3>
                </div>
                <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-white/10 rounded-full"></div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                <p class="text-gray-500 text-sm">Completed Courses</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $completed_courses }}</h3>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                <p class="text-gray-500 text-sm">Average Grade</p>
                <div class="flex items-end gap-2">
                    <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $average_grade }}</h3>
                    <span class="text-green-500 text-sm font-medium mb-1.5">Excellent!</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-6">
                <h2 class="text-lg font-bold text-gray-800">Continue Learning</h2>
                
                <div class="bg-white p-4 rounded-2xl border border-gray-100 shadow-sm flex flex-col md:flex-row gap-6">
                    <div class="w-full md:w-48 h-32 bg-gray-200 rounded-xl overflow-hidden shrink-0">
                        <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=600&q=80" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1 flex flex-col justify-center">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <span class="text-xs font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded">Web Dev</span>
                                <h3 class="text-lg font-bold text-gray-800 mt-2">Fullstack Laravel & React</h3>
                            </div>
                        </div>
                        <div class="mt-auto">
                            <div class="flex justify-between text-xs font-semibold text-gray-500 mb-1">
                                <span>Chapter 4: Database Migration</span>
                                <span>75%</span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-2">
                                <div class="bg-blue-600 h-2 rounded-full" style="width: 75%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <h2 class="text-lg font-bold text-gray-800 mb-6">Upcoming Tasks</h2>
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 space-y-6">
                    @foreach($upcoming_tasks as $task)
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-full bg-red-50 text-red-500 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-gray-800">{{ $task['task'] }}</h4>
                            <p class="text-xs text-gray-500 mt-0.5">{{ $task['course'] }}</p>
                            <span class="text-xs font-medium text-red-500 bg-red-50 px-2 py-0.5 rounded mt-2 inline-block">Due: {{ $task['due'] }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

    @endif
@endsection