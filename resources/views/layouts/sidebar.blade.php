<aside
    class="w-64 bg-[#0B1120] text-gray-400 flex flex-col h-screen fixed left-0 top-0 overflow-y-auto border-r border-gray-800 font-sans">
    <div class="p-6 flex items-center gap-3">
        <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.499 5.216 50.59 50.59 0 00-2.658.812m-15.482 0a50.57 50.57 0 012.658.812m12.824 0a50.57 50.57 0 00-2.658-.812" />
            </svg>
        </div>
        <span class="text-white text-xl font-bold tracking-wide">Eduvi</span>
    </div>

    <nav class="flex-1 px-4 space-y-2 mt-4">
        <a href="{{route('dashboard.index')}}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-800 transition-colors group">
            <svg class="w-5 h-5 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('classes.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors group {{ request()->routeIs('classes.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/30' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
            <svg class="w-5 h-5 {{ request()->routeIs('classes.*') ? 'text-white' : 'group-hover:text-white' }}"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg>
            <span class="{{ request()->routeIs('classes.*') ? 'font-medium' : '' }}">
                My Class
            </span>
        </a>

        <a href="{{ route('courses.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors group {{ request()->routeIs('courses.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/30' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
            <svg class="w-5 h-5 {{ request()->routeIs('courses.*') ? 'text-white' : 'group-hover:text-white' }}"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
            </svg>
            <span class="{{ request()->routeIs('courses.*') ? 'font-medium' : '' }}">
                Courses
            </span>
        </a>
<!-- 
        <a href="#"
            class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-800 hover:text-white transition-colors">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
            <span>Messages</span>
        </a>

        <a href="#"
            class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-800 hover:text-white transition-colors">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            <span>Instructors</span>
        </a> -->
    </nav>

    <div class="p-4 border-t border-gray-800">
        <div class="flex items-center justify-between gap-2">

            <div class="flex items-center gap-3 overflow-hidden">
                <div
                    class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold shrink-0">
                    {{ strtoupper(substr(auth()->user()->name ?? 'GU', 0, 2)) }}
                </div>

                <div class="flex flex-col">
                    <p class="text-sm font-semibold text-white truncate max-w-[100px]"
                        title="{{ auth()->user()->name ?? 'Guest' }}">
                        {{ auth()->user()->name ?? 'Guest' }}
                    </p>
                    <p class="text-xs text-gray-500 capitalize">
                        {{ auth()->user()->role ?? 'Visitor' }}
                    </p>
                </div>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="p-2 text-gray-400 hover:text-red-400 hover:bg-gray-800 rounded-lg transition-colors"
                    title="Logout">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                    </svg>
                </button>
            </form>

        </div>
    </div>
</aside>