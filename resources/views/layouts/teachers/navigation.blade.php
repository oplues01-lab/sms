<aside class="w-64 bg-white border-r border-gray-200 flex flex-col h-screen sticky top-0">
    <!-- Logo -->
    <div class="flex items-center justify-center h-16 border-b bg-indigo-600">
        <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
            <x-application-logo class="block h-8 w-auto fill-current text-white" />
            <span class="text-white font-bold text-lg">{{ config('app.name', 'Laravel') }}</span>
        </a>
    </div>

    <!-- Navigation Links -->
    <nav class="flex-1 p-4 space-y-1 overflow-y-auto">

        <!-- Dashboard -->
        <x-nav-link
            :href="route('students.portal.dashboard')"
            :active="request()->routeIs('students.portal.dashboard')"
            class="flex items-center space-x-2 py-2 px-3 rounded-lg text-sm transition-colors duration-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3" />
            </svg>
            <span>{{ __('Dashboard') }}</span>
        </x-nav-link>

        <hr class="my-2 border-gray-200">

        <!-- Assignments -->
        <x-nav-link
            :href="route('students.assignments.index')"
            :active="request()->routeIs('students.assignments.*')"
            class="flex items-center space-x-2 py-2 px-3 rounded-lg text-sm transition-colors duration-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v14l-4-2-4 2-4-2-4 2V6a2 2 0 012-2z" />
            </svg>
            <span>{{ __('Assignments') }}</span>
        </x-nav-link>

        <!-- Results -->
        <x-nav-link
            :href="route('students.assignments.results')"
            :active="request()->routeIs('students.assignments.results')"
            class="flex items-center space-x-2 py-2 px-3 rounded-lg text-sm transition-colors duration-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M11 11V7a1 1 0 112 0v4m-1 4h.01M12 18h.01M12 6h.01M5 12h.01M19 12h.01" />
            </svg>
            <span>{{ __('My Results') }}</span>
        </x-nav-link>

        <hr class="my-2 border-gray-200">

        <!-- Questions -->
        <x-nav-link
            :href="route('teacher.questions.create')"
            :active="request()->routeIs('teacher.questions.*')"
            class="flex items-center space-x-2 py-2 px-3 rounded-lg text-sm transition-colors duration-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            <span>{{ __('Set Question') }}</span>
        </x-nav-link>

        <hr class="my-2 border-gray-200">

        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-left px-3 py-2 text-red-600 hover:bg-gray-100 rounded-lg">
                <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7" />
                </svg>
                {{ __('Logout') }}
            </button>
        </form>

    </nav>
</aside>
