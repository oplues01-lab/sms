<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Subject Allocation') }}
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
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Subject Allocation List</h2>

                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-200 divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">S/N</th>                             
                                  <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">Teacher</th>                             

                               <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">Subjects</th>                             
                                 <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">Class</th>

                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">Classarm</th>
                                <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700 uppercase">Action</th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($teachers as $teacher)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $loop->iteration }}</td>
                                  
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $teacher->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $teacher->subjects->pluck('name')->join(', ') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $teacher->classes->pluck('name')->join(', ') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $teacher->classarms->pluck('name')->join(', ') }}</td>

                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <!-- <a href="" 
                                           class="inline-block px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-md hover:bg-blue-700 transition">
                                            View
                                        </a> -->
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if($teachers->isEmpty())
                    <p class="text-center py-6 text-gray-500">No subject allocation found.</p>
                @endif
            </div>
        </div>
    </div>
</div>

</x-app-layout>