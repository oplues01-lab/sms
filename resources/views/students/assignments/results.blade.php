@extends('layouts.students.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Student Assignments Results
    </h2>
@endsection

@section('content')

<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="bg-gradient-to-r from-green-600 to-emerald-700 rounded-lg shadow-lg p-6 mb-6">
        <h1 class="text-3xl font-bold text-white">My Results & Grades</h1>
        <p class="text-green-100 mt-2">View your graded assignments and performance</p>
    </div>

    <!-- Overall Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-green-500">
            <h3 class="text-sm text-gray-600 font-medium mb-2">Total Graded</h3>
            <p class="text-4xl font-bold text-gray-800">{{ $gradedSubmissions->total() }}</p>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-500">
            <h3 class="text-sm text-gray-600 font-medium mb-2">Average Score</h3>
            <p class="text-4xl font-bold text-blue-600">
                {{ $gradedSubmissions->avg(function($submission) {
                    return $submission->getPercentage();
                }) ? number_format($gradedSubmissions->avg(function($submission) {
                    return $submission->getPercentage();
                }), 1) : 0 }}%
            </p>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-purple-500">
            <h3 class="text-sm text-gray-600 font-medium mb-2">Total Marks Earned</h3>
            <p class="text-4xl font-bold text-purple-600">
                {{ $gradedSubmissions->sum('marks_obtained') }}/{{ $gradedSubmissions->sum(function($s) { return $s->assignment->total_marks; }) }}
            </p>
        </div>
    </div>

    <!-- Graded Assignments List -->
    @if($gradedSubmissions->count() > 0)
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Assignment
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Subject
                        </th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Score
                        </th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Percentage
                        </th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Grade
                        </th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Graded On
                        </th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($gradedSubmissions as $submission)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ $submission->assignment->title }}</div>
                            @if($submission->isLate())
                                <div class="text-xs text-red-600 font-semibold mt-1">Late Submission</div>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $submission->assignment->subject->name }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="text-lg font-bold text-gray-800">
                                {{ $submission->marks_obtained }}/{{ $submission->assignment->total_marks }}
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold
                                {{ $submission->getPercentage() >= 70 ? 'bg-green-100 text-green-800' : 
                                   ($submission->getPercentage() >= 50 ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800') }}">
                                {{ $submission->getPercentage() }}%
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full text-lg font-bold
                                {{ $submission->getGrade() === 'A' ? 'bg-green-100 text-green-800' : 
                                   ($submission->getGrade() === 'B' ? 'bg-blue-100 text-blue-800' : 
                                   ($submission->getGrade() === 'C' ? 'bg-yellow-100 text-yellow-800' : 
                                   ($submission->getGrade() === 'D' ? 'bg-orange-100 text-orange-800' : 'bg-red-100 text-red-800'))) }}">
                                {{ $submission->getGrade() }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600 text-center">
                            {{ $submission->graded_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('student.assignments.show', $submission->assignment) }}" 
                               class="text-blue-600 hover:text-blue-800 font-medium text-sm">
                                View Details
                            </a>
                        </td>
                    </tr>
                    @if($submission->teacher_feedback)
                    <tr class="bg-blue-50">
                        <td colspan="7" class="px-6 py-3">
                            <div class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                                </svg>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-700">Teacher's Feedback:</p>
                                    <p class="text-sm text-gray-600 mt-1">{{ $submission->teacher_feedback }}</p>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $gradedSubmissions->links() }}
    </div>
    @else
    <div class="bg-white rounded-lg shadow-md p-12 text-center">
        <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
        </svg>
        <h3 class="text-xl font-semibold text-gray-700 mb-2">No graded assignments yet</h3>
        <p class="text-gray-500">Your graded assignments will appear here once your teacher grades them.</p>
    </div>
    @endif

    <!-- Performance Chart Placeholder -->
    @if($gradedSubmissions->count() > 0)
    <div class="mt-6 bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Performance Overview</h2>
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
            @php
                $gradeDistribution = $gradedSubmissions->groupBy(function($submission) {
                    return $submission->getGrade();
                })->map->count();
            @endphp
            
            @foreach(['A', 'B', 'C', 'D', 'F'] as $grade)
            <div class="text-center p-4 rounded-lg {{ $grade === 'A' ? 'bg-green-50' : ($grade === 'B' ? 'bg-blue-50' : ($grade === 'C' ? 'bg-yellow-50' : ($grade === 'D' ? 'bg-orange-50' : 'bg-red-50'))) }}">
                <div class="text-3xl font-bold {{ $grade === 'A' ? 'text-green-600' : ($grade === 'B' ? 'text-blue-600' : ($grade === 'C' ? 'text-yellow-600' : ($grade === 'D' ? 'text-orange-600' : 'text-red-600'))) }}">
                    {{ $gradeDistribution[$grade] ?? 0 }}
                </div>
                <div class="text-sm text-gray-600 mt-1">Grade {{ $grade }}</div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
