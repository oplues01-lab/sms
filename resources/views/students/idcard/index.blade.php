<x-app-layout>
    <div class="max-w-4xl mx-auto py-10">
        <h2 class="text-xl font-bold mb-6">Student ID Card</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <a href="{{ route('students.idcard.side', [$student->id, 'front']) }}"
               class="border p-6 rounded-lg shadow hover:shadow-lg">
                <h3 class="font-bold text-lg">Front</h3>
                <p class="text-sm text-gray-500">Click to view</p>
            </a>

            <a href="{{ route('students.idcard.side', [$student->id, 'back']) }}"
               class="border p-6 rounded-lg shadow hover:shadow-lg">
                <h3 class="font-bold text-lg">Back</h3>
                <p class="text-sm text-gray-500">Click to view</p>
            </a>
        </div>
    </div>
</x-app-layout>
