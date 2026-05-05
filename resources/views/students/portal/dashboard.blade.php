@extends('layouts.students.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Student Dashboard
    </h2>
@endsection

@section('content')

<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <!-- Welcome Header -->
    <div class="bg-gradient-to-r from-indigo-600 to-purple-700 rounded-lg shadow-lg p-8 mb-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-bold mb-2">Welcome back, {{ $student->first_name }}!</h1>
                <p class="text-indigo-100 text-lg">
                    {{ $student->classes->name ?? 'N/A' }} - {{ $student->class_arm->name ?? '' }}
                </p>
            </div>
            <div class="hidden md:block">
                @if($student->photo)
                    <img src="{{ Storage::url('students/' . $student->photo) }}" 
                         class="w-24 h-24 rounded-full border-4 border-white shadow-lg object-cover"
                         alt="{{ $student->first_name }}">
                @else
                    <div class="w-24 h-24 rounded-full bg-white/20 flex items-center justify-center border-4 border-white shadow-lg">
                        <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-yellow-500">
            <p class="text-sm text-gray-600 font-medium">Pending Assignments</p>
            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['pending_assignments'] }}</p>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-500">
            <p class="text-sm text-gray-600 font-medium">Submitted</p>
            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['submitted_assignments'] }}</p>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-green-500">
            <p class="text-sm text-gray-600 font-medium">Graded</p>
            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['graded_assignments'] }}</p>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-purple-500">
            <p class="text-sm text-gray-600 font-medium">Average Score</p>
            <p class="text-3xl font-bold text-gray-800 mt-2">{{ number_format($stats['average_score'], 1) }}%</p>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="mt-6 bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Quick Actions</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('students.assignments.index') }}" class="p-4 border rounded-lg hover:shadow">
                📘 View Assignments
            </a>

            <a href="{{ route('students.assignments.results') }}" class="p-4 border rounded-lg hover:shadow">
                ✅ My Results
            </a>

            <a href="{{ route('students.portal.profile') }}" class="p-4 border rounded-lg hover:shadow">
                👤 My Profile
            </a>
        </div>
    </div>
</div>

@endsection
