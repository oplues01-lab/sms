










<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Classes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if(session('success'))
    <div class="mb-4 rounded-lg bg-green-100 border border-green-400 text-green-700 px-4 py-3">
        {{ session('success') }}
    </div>
        @endif

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Class List</h2>

                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-200 divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">S/N</th>
                               <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">Name</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">Code</th>
                                                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">Created At</th>

                                <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700 uppercase">Action</th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($classes as $class) 
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{$loop->iteration}}</td>
                                  
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $class->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $class->code }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $class->created_at }}</td>
                                    
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <a class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-gray-700 transition" href="{{ route('classes.edit', $class->id) }}">Edit</a>
                                        @if($class->status)
                                        <form class="inline-block"  action="{{ route('classes.deactivate', $class->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to deactivate this class?')">
                                            @csrf 
                                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-gray-700 transition">
                                                Deactivate
                                        </button>
                                        </form>

                                        @else 
                                         <form class="inline-block" action="{{ route('classes.activate', $class->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to activate this class?')">
                                            @csrf 

                                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-gray-700 transition">
                                                Activate
                                            </button>
                                        </form>



                                       @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if($classes->isEmpty())
                    <p class="text-center py-6 text-gray-500">No class found.</p>
                @endif
            </div>
        </div>





    


    </div>
</x-app-layout>
