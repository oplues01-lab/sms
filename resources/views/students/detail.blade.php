<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Student Profile
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-5xl mx-auto bg-white rounded-lg shadow p-6">

            <!-- ACTIONS -->
            <div class="flex justify-end gap-3 mb-6">
                <a href="{{ route('students.edit', $student->id) }}"
                   class="bg-blue-600 text-white px-4 py-2 rounded">
                    Edit
                </a>

                @if($student->status === 0)
                    <form method="POST" action="{{ route('students.deactivate', $student->id) }}">
                        @csrf
                        <button class="bg-red-600 text-white px-4 py-2 rounded">
                            Activate
                        </button>
                    </form>
                @else
                    <form method="POST" action="{{ route('students.activate', $student->id) }}">
                        @csrf
                        <button class="bg-red-600 text-white px-4 py-2 rounded">
                            Deactivate
                        </button>
                    </form>
                @endif
            </div>

            <!-- PROFILE -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-2 space-y-2">
                    <p><strong>Name:</strong> {{ $student->first_name }} {{ $student->last_name }}</p>
                    <p><strong>Admission No:</strong> {{ $student->admission_no }}</p>
                    <p><strong>Class:</strong> {{ $student->classes->name ?? 'N/A' }}</p>
                    <p><strong>Arm:</strong> {{ $student->class_arm->name ?? 'N/A' }}</p>
                    <p><strong>Session:</strong> {{ $student->academicsessions->name ?? 'N/A' }}</p>
                    <p><strong>Status:</strong>
                        <span class="px-2 py-1 rounded text-white
                            {{ $student->status === 1 ? 'bg-green-600' : 'bg-red-600' }}">
                            Active
                        </span>
                    </p>
                </div>

                <div class="flex justify-center">
                    <img src="{{ asset('storage/students/'.$student->photo) }}"
                         class="w-40 h-40 rounded-full border">
                </div>
            </div>

            <!-- ID CARD -->
            <div class="mt-8">
                <h3 class="text-lg font-bold mb-4">Student ID Card</h3>

                <a href="{{ route('students.idcard', $student->id) }}"
                   class="inline-block border rounded-lg p-6 hover:shadow-lg transition">
                    <p class="font-semibold">View ID Card</p>
                    <p class="text-sm text-gray-500">Front & Back</p>
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
