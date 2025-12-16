@extends('layouts.main')

@section('content')
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Browse Courses</h1>
            <p class="text-gray-500 mt-1">Explore new skills and knowledge.</p>
        </div>

        <div class="flex gap-3">
            <div class="relative">
                <input type="text" placeholder="Search courses..." 
                       class="pl-10 pr-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 w-64 shadow-sm">
                <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>

            <button class="flex items-center gap-2 px-4 py-2.5 bg-white border border-gray-200 text-gray-600 rounded-xl text-sm font-medium hover:bg-gray-50 shadow-sm transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                </svg>
                <span>Filter</span>
            </button>
        </div>
    </div>

    <div class="flex flex-wrap gap-2 mb-8">
        <button class="px-4 py-1.5 bg-blue-600 text-white text-sm rounded-full shadow-md shadow-blue-500/20">All</button>
        <button class="px-4 py-1.5 bg-white text-gray-500 border border-gray-200 text-sm rounded-full hover:bg-gray-50">Design</button>
        <button class="px-4 py-1.5 bg-white text-gray-500 border border-gray-200 text-sm rounded-full hover:bg-gray-50">Development</button>
        <button class="px-4 py-1.5 bg-white text-gray-500 border border-gray-200 text-sm rounded-full hover:bg-gray-50">Business</button>
        <button class="px-4 py-1.5 bg-white text-gray-500 border border-gray-200 text-sm rounded-full hover:bg-gray-50">Marketing</button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        <div class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition-all p-4 border border-gray-100 group cursor-pointer">
            <div class="h-44 rounded-xl bg-gray-200 overflow-hidden mb-4 relative">
                <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=600&q=80" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" alt="Course">
                <span class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm px-2.5 py-1 rounded-md text-xs font-bold text-blue-600">
                    Technology
                </span>
            </div>
            
            <div class="mb-3">
                <div class="flex items-center gap-2 mb-2">
                    <span class="text-xs font-medium text-gray-400">By Michael Scott</span>
                </div>
                <h3 class="text-lg font-bold text-gray-800 leading-tight group-hover:text-blue-600 transition-colors">
                    Machine Learning A-Z™: Hands-On Python
                </h3>
            </div>

            <div class="flex items-center gap-1 mb-4 text-sm">
                <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                <span class="font-bold text-gray-700">4.8</span>
                <span class="text-gray-400">(1,240 Reviews)</span>
            </div>

            <div class="flex items-center justify-between pt-4 border-t border-gray-50">
                <div class="text-xl font-bold text-gray-800">$12.99</div>
                <button class="px-4 py-2 bg-blue-50 text-blue-600 text-sm font-semibold rounded-lg hover:bg-blue-600 hover:text-white transition-colors">
                    Enroll Now
                </button>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition-all p-4 border border-gray-100 group cursor-pointer">
            <div class="h-44 rounded-xl bg-gray-200 overflow-hidden mb-4 relative">
                <img src="https://images.unsplash.com/photo-1561070791-2526d30994b5?auto=format&fit=crop&w=600&q=80" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" alt="Course">
                <span class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm px-2.5 py-1 rounded-md text-xs font-bold text-purple-600">
                    Design
                </span>
            </div>
            <div class="mb-3">
                <div class="flex items-center gap-2 mb-2">
                    <span class="text-xs font-medium text-gray-400">By Sarah Tan</span>
                </div>
                <h3 class="text-lg font-bold text-gray-800 leading-tight group-hover:text-blue-600 transition-colors">
                    Product Design Masterclass for Beginners
                </h3>
            </div>
            <div class="flex items-center gap-1 mb-4 text-sm">
                <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                <span class="font-bold text-gray-700">4.9</span>
                <span class="text-gray-400">(850 Reviews)</span>
            </div>
            <div class="flex items-center justify-between pt-4 border-t border-gray-50">
                <div class="text-xl font-bold text-gray-800">Free</div>
                <button class="px-4 py-2 bg-blue-50 text-blue-600 text-sm font-semibold rounded-lg hover:bg-blue-600 hover:text-white transition-colors">
                    Join Free
                </button>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition-all p-4 border border-gray-100 group cursor-pointer">
            <div class="h-44 rounded-xl bg-gray-200 overflow-hidden mb-4 relative">
                <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=600&q=80" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" alt="Course">
                <span class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm px-2.5 py-1 rounded-md text-xs font-bold text-green-600">
                    Business
                </span>
            </div>
            <div class="mb-3">
                <div class="flex items-center gap-2 mb-2">
                    <span class="text-xs font-medium text-gray-400">By John Doe</span>
                </div>
                <h3 class="text-lg font-bold text-gray-800 leading-tight group-hover:text-blue-600 transition-colors">
                    Startup Valuation and Strategy
                </h3>
            </div>
            <div class="flex items-center gap-1 mb-4 text-sm">
                <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                <span class="font-bold text-gray-700">4.5</span>
                <span class="text-gray-400">(210 Reviews)</span>
            </div>
            <div class="flex items-center justify-between pt-4 border-t border-gray-50">
                <div class="text-xl font-bold text-gray-800">$24.99</div>
                <button class="px-4 py-2 bg-blue-50 text-blue-600 text-sm font-semibold rounded-lg hover:bg-blue-600 hover:text-white transition-colors">
                    Enroll Now
                </button>
            </div>
        </div>

    </div>
@endsection