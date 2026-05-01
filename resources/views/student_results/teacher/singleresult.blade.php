<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Subject Results') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow">
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-2">#</th>
                            <th class="border p-2">Student Name</th>
                            <th class="border p-2">CA</th>
                            <th class="border p-2">Exam</th>
                            <th class="border p-2">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($results as $index => $result)
                            <tr>
                                <td class="border p-2 text-center">{{ $index + 1 }}</td>
                                <td class="border p-2">{{ $result->student->admission_no ?? 'N/A' }}</td>
                                <td class="border p-2 text-center">{{ $result->ca_score }}</td>
                                <td class="border p-2 text-center">{{ $result->exam_score }}</td>
                                <td class="border p-2 text-center font-semibold">{{ $result->total }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
