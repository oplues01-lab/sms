<x-app-layout>
    <div class="max-w-4xl mx-auto py-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- FRONT -->
            <div class="border p-6 rounded-lg shadow">
                <h2 class="font-bold text-xl mb-4">ID Card (Front)</h2>

                <div class="flex items-center gap-4">
                    <img src="{{ asset('storage/students/'.$student->photo) }}" class="w-28 h-28 rounded-full border">
                    <div>
                        <p class="font-semibold text-lg">{{ $student->first_name }} {{ $student->last_name }}</p>
                        <p class="text-gray-600">Reg No: {{ $student->admission_no }}</p>
                        <p class="text-gray-600">Class: {{ $student->classes->name ?? 'N/A' }}</p>
                        <p class="text-gray-600">Arm: {{ $student->class_arm->name ?? 'N/A' }}</p>
                    </div>
                </div>

                <div class="mt-4">
                    <p class="text-sm">School Name</p>
                    <p class="text-sm">Address</p>
                    <p class="text-sm">Phone</p>
                </div>
            </div>

            <!-- BACK -->
            <div class="border p-6 rounded-lg shadow">
                <h2 class="font-bold text-xl mb-4">ID Card (Back)</h2>

                <div class="text-sm">
                    <p><strong>Term:</strong> {{ $student->term->name ?? 'N/A' }}</p>
                    <p><strong>Session:</strong> {{ $student->academicsessions->name ?? 'N/A' }}</p>
                    <p><strong>Email:</strong> {{ $student->email }}</p>
                    <p><strong>Phone:</strong> {{ $student->phone ?? 'N/A' }}</p>

                    <div class="mt-4">
                        <p class="text-gray-700">Emergency Contact:</p>
                        <p class="text-gray-700">Name: {{ $student->parent_name ?? 'N/A' }}</p>
                        <p class="text-gray-700">Phone: {{ $student->parent_phone ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

        </div>

        <div class="mt-6">
            <a href="{{ route('students.idcard.print', $student->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded">
                Print ID Card
            </a>
        </div>
    </div>
</x-app-layout>
