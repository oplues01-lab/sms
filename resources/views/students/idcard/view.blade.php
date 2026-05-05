<x-app-layout>
    <div class="max-w-4xl mx-auto py-10">

        <div class="flex justify-between mb-6">
            <a href="{{ route('students.idcard', $student->id) }}"
               class="bg-gray-600 text-white px-4 py-2 rounded">
                Back
            </a>

            <a href="{{ route('students.idcard.print', $student->id) }}"
               class="bg-blue-600 text-white px-4 py-2 rounded">
                Print
            </a>
        </div>

        @if($side === 'front')
            <!-- FRONT -->
            <div class="border rounded-lg p-6 shadow">
                <div class="flex items-center gap-4">
                    <img src="{{ asset('storage/students/'.$student->photo) }}"
                         class="w-28 h-28 rounded-full border">
                    <div>
                        <p class="font-bold text-lg">
                            {{ $student->first_name }} {{ $student->last_name }}
                        </p>
                        <p>Reg No: {{ $student->admission_no }}</p>
                        <p>Class: {{ $student->classes->name ?? 'N/A' }}</p>
                        <p>Arm: {{ $student->class_arm->name ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
        @else
            <!-- BACK -->
            <div class="border rounded-lg p-6 shadow text-sm">
                <p><strong>Session:</strong> {{ $student->academicsessions->name ?? 'N/A' }}</p>
                <p><strong>Email:</strong> {{ $student->email }}</p>
                <p><strong>Phone:</strong> {{ $student->phone ?? 'N/A' }}</p>

                <div class="mt-4">
                    <p class="font-semibold">Emergency Contact</p>
                    <p>{{ $student->parent_name ?? 'N/A' }}</p>
                    <p>{{ $student->parent_phone ?? 'N/A' }}</p>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
