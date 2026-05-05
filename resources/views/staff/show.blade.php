<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Staff Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                     <p><strong>Status:</strong>
 
                        <span class="{{ $staff->status ? 'text-green-600' : 'text-red-600' }} font-semibold">
                            {{$staff->status ? 'Active' : ' Inactive' }}
                        </span>

                    </p>

                    <h3 class="text-2xl font-bold mb-4">{{ $staff->user->name ?? 'N/A' }}</h3>

                    <div class="space-y-3">
                        <p><strong>Designation:</strong> {{ $staff->designation ?? 'N/A' }}</p>
                        <p><strong>Salary:</strong> ₦{{ number_format($staff->salary, 2) ?? 'N/A' }}</p>
                        <p><strong>Role:</strong> {{ $staff->user->role ?? 'N/A' }}</p>
                        <p><strong>Email:</strong> {{ $staff->user->email ?? 'N/A' }}</p>
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('staff.index') }}" 
                           class="inline-block px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 transition">
                            Back
                        </a>

                              <a href="{{ route('staff.edit', $staff->id) }}" 
                           class="inline-block px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 transition">
                            Edit
                            </a>

                        @if($staff->status)
                        <form class="inline-block"  action="{{ route('staff.deactivate', $staff->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to deactivate this staff?')">
                            @csrf 
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-gray-700 transition">
                            Deactivate
                        </button>

                        </form>
                        @else 
                         <form class="inline-block"  action="{{ route('staff.activate', $staff->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to activate this staff?')">
                            @csrf 
                            <button type="submit" class="inline-block px-4 py-2 bg-red-600 text-white rounded hover:bg-gray-700 transition">
                            Activate
                        </button>

                        </form>


                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>