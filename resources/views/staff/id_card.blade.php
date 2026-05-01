<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl">
        Staff ID Card — {{ ucfirst($side) }}
    </h2>
</x-slot>

<style>
.id-card {
    width: 340px;
    height: 520px;
    border: 2px solid #1e40af;
    border-radius: 14px;
    margin: auto;
    padding: 16px;
    background: #fff;
}
</style>

<div class="py-8">
    <div class="id-card">

        @if($side === 'front')
            <div class="text-center">
                <h3 class="font-bold text-lg">YOUR SCHOOL NAME</h3>

                <img
                    src="{{ asset('storage/staff/'.$staff->photo) }}"
                    class="w-28 h-28 rounded-full mx-auto mt-4 object-cover"
                >

                <h4 class="mt-4 font-semibold">
                    {{ $staff->user->name }}
                </h4>

                <p class="text-sm text-gray-600">
                    {{ $staff->designation }}
                </p>

                <p class="mt-3 text-xs">
                    Staff ID: {{ str_pad($staff->id, 5, '0', STR_PAD_LEFT) }}
                </p>
            </div>
        @else
            <div class="text-sm">
                <p><strong>School:</strong> YOUR SCHOOL NAME</p>
                <p><strong>Location:</strong> Nigeria</p>

                <div class="mt-6">
                    <p>
                        This card remains the property of the school.
                        If found, please return it immediately.
                    </p>
                </div>

                <div class="mt-10 text-right">
                    ___________________<br>
                    Authorized Signature
                </div>
            </div>
        @endif

    </div>

    <div class="text-center mt-5">
        <button onclick="window.print()"
                class="px-4 py-2 bg-green-600 text-white rounded">
            Print ID Card
        </button>
    </div>
</div>
</x-app-layout>
