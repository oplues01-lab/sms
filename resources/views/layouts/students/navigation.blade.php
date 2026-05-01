<aside class="w-64 bg-white border-r border-gray-200 flex flex-col h-screen sticky top-0">
    <!-- Logo -->
    <div class="flex items-center justify-center h-16 border-b bg-indigo-600">
        <a href="{{ route('students.portal.dashboard') }}" class="flex items-center space-x-2">
            <x-application-logo class="block h-8 w-auto fill-current text-white" />
            <span class="text-white font-bold text-lg">{{ config('app.name', 'Laravel') }}</span>
        </a>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 p-4 space-y-2 overflow-y-auto">

        <!-- Dashboard -->
        <x-nav-link
            :href="route('students.portal.dashboard')"
            :active="request()->routeIs('students.portal.dashboard')"
            class="flex items-center space-x-2 py-2 px-3 rounded-lg">
            <span>🏠</span>
            <span>Dashboard</span>
        </x-nav-link>

        <!-- Assignments -->
        <x-nav-link
            :href="route('students.assignments.index')"
            :active="request()->routeIs('students.assignments.*')"
            class="flex items-center space-x-2 py-2 px-3 rounded-lg">
            <span>📘</span>
            <span>My Assignments</span>
        </x-nav-link>

        <!-- Results -->
        <x-nav-link
            :href="route('students.assignments.results')"
            :active="request()->routeIs('students.assignments.results')"
            class="flex items-center space-x-2 py-2 px-3 rounded-lg">
            <span>📊</span>
            <span>My Results</span>
        </x-nav-link>

        <!-- Profile -->
        <x-nav-link
            :href="route('students.portal.profile')"
            :active="request()->routeIs('students.portal.profile')"
            class="flex items-center space-x-2 py-2 px-3 rounded-lg">
            <span>👤</span>
            <span>Profile</span>
        </x-nav-link>

    </nav>

    <!-- User & Logout -->
    <div class="border-t p-4 bg-gray-50">
        <div class="mb-3">
            <div class="font-medium text-gray-800">{{ Auth::user()->name }}</div>
            <div class="text-sm text-gray-500">{{ Auth::user()->email }}</div>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="w-full text-left px-3 py-2 text-red-600 hover:bg-red-50 rounded">
                Logout
            </button>
        </form>
    </div>
</aside>
