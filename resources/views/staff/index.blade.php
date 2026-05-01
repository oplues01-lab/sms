<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Classes') }}
        </h2>
    </x-slot>

   <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="mb-4 rounded-lg bg-green-100 border border-green-400 text-green-700 px-4 py-3">

                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Staff List</h2>

                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-200 divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">S/N</th>
                               <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">Name</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">Designation</th>
                                <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700 uppercase">Action</th>
                                <th class="px-6 py-3 text-center">Photo</th>

                          
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($staffs as $staff)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $loop->iteration }}</td>
                                  
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $staff->user->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $staff->designation }}</td>

                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <a href="{{ route('staff.show', $staff->id ) }}" 
                                           class="inline-block px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-md hover:bg-blue-700 transition">
                                            View
                                        </a>
                                    </td>


                                    <td class="text-center">
                                <details class="inline-block">
                                    <summary class="cursor-pointer px-3 py-1 bg-blue-600 text-white rounded">
                                        ID Card
                                    </summary>
                                    <div class="border bg-white shadow rounded mt-1">
                                        <a href="{{ route('staff.id.card', [$staff->id, 'front']) }}"
                                        class="block px-4 py-2 hover:bg-gray-100">
                                            Front
                                        </a>
                                        <a href="{{ route('staff.id.card', [$staff->id, 'back']) }}"
                                        class="block px-4 py-2 hover:bg-gray-100">
                                            Back
                                        </a>
                                    </div>
                                </details>
                            </td>
<td class="px-6 py-4 text-center">
    <a href="{{ route('staff.photo.create', $staff->id) }}"
       class="px-3 py-1 bg-indigo-600 text-white rounded text-sm">
        Capture Photo
    </a>
</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if($staffs->isEmpty())
                    <p class="text-center py-6 text-gray-500">No staff found.</p>
                @endif
            </div>
        </div>
    </div>
</div>

</x-app-layout>