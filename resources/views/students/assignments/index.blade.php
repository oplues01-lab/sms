@extends('layouts.students.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Student Assignments
    </h2>
@endsection

@section('content')

<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-lg shadow-lg p-6 mb-6">
        <h1 class="text-3xl font-bold text-white">My Assignments</h1>
        <p class="text-blue-100 mt-2">View and submit your assignments</p>
    </div>

    <!-- Filter Tabs -->
    <div class="bg-white rounded-lg shadow-md p-4 mb-6">
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('students.assignments.index') }}" 
               class="px-4 py-2 rounded-lg font-medium transition {{ !request('filter') ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                All Assignments
            </a>
            <a href="{{ route('students.assignments.index', ['filter' => 'pending']) }}" 
               class="px-4 py-2 rounded-lg font-medium transition {{ request('filter') === 'pending' ? 'bg-yellow-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Pending
            </a>
            <a href="{{ route('students.assignments.index', ['filter' => 'submitted']) }}" 
               class="px-4 py-2 rounded-lg font-medium transition {{ request('filter') === 'submitted' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Submitted
            </a>
            <a href="{{ route('students.assignments.index', ['filter' => 'graded']) }}" 
               class="px-4 py-2 rounded-lg font-medium transition {{ request('filter') === 'graded' ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Graded
            </a>
        </div>
    </div>

    <!-- Assignments List -->
    @if($assignments->count() > 0)
    <div class="space-y-4">
        @foreach($assignments as $assignment)
        @php
            $submission = $submissions[$assignment->id] ?? null;
        @endphp
        
        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition border-l-4 
            {{ $submission && $submission->status === 'graded' ? 'border-green-500' : 
               ($submission && $submission->status === 'submitted' ? 'border-blue-500' : 
               ($assignment->isOverdue() ? 'border-red-500' : 'border-yellow-500')) }}">
            <div class="p-6">
                <div class="flex justify-between items-start mb-4">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <h3 class="text-xl font-bold text-gray-800">{{ $assignment->title }}</h3>
                            
                            @if($submission)
                                <span class="px-3 py-1 text-xs font-semibold rounded-full
                                    {{ $submission->status === 'graded' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                    {{ ucfirst($submission->status) }}
                                </span>
                            @elseif($assignment->isOverdue())
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                    Overdue
                                </span>
                            @else
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Pending
                                </span>
                            @endif

                            @if($submission && $submission->isLate())
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                    Late Submission
                                </span>
                            @endif
                        </div>

                        <p class="text-gray-600 mb-3">{{ Str::limit($assignment->description, 150) }}</p>

                        <div class="flex flex-wrap gap-4 text-sm text-gray-600 mb-3">
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                                {{ $assignment->subject->name }}
                            </span>
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                {{ $assignment->teacher->name }}
                            </span>
                            <span class="flex items-center gap-1 {{ $assignment->isOverdue() && !$submission ? 'text-red-600 font-semibold' : '' }}">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Due: {{ $assignment->due_date->format('M d, Y h:i A') }}
                            </span>
                            <span class="flex items-center gap-1 font-medium">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                </svg>
                                {{ $assignment->total_marks }} marks
                            </span>
                        </div>

                        @if($submission && $submission->status === 'graded')
                        <div class="bg-green-50 border border-green-200 rounded-lg p-4 mt-3">
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-sm text-gray-600 mb-1">Your Score:</p>
                                    <p class="text-3xl font-bold text-green-600">{{ $submission->marks_obtained }}/{{ $assignment->total_marks }}</p>
                                    <p class="text-sm text-gray-600 mt-1">Grade: {{ $submission->getGrade() }} ({{ $submission->getPercentage() }}%)</p>
                                </div>
                                @if($submission->teacher_feedback)
                                <div class="flex-1 ml-6">
                                    <p class="text-sm font-medium text-gray-700 mb-1">Feedback:</p>
                                    <p class="text-sm text-gray-600">{{ $submission->teacher_feedback }}</p>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="ml-4">
                        <a href="{{ route('students.assignments.show', $assignment) }}" 
                           class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition font-medium text-sm whitespace-nowrap">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $assignments->links() }}
    </div>
    @else
    <div class="bg-white rounded-lg shadow-md p-12 text-center">
        <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
        </svg>
        <h3 class="text-xl font-semibold text-gray-700 mb-2">No assignments found</h3>
        <p class="text-gray-500">
            @if(request('filter'))
                No {{ request('filter') }} assignments at the moment.
            @else
                You don't have any assignments yet.
            @endif
        </p>
    </div>
    @endif
</div>
@endsection
