<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800">
        Capture Staff Photo — {{ $staff->user->name }}
    </h2>
</x-slot>

<div class="py-10">
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">

<form method="POST"
      action="{{ route('staff.photo.store', $staff->id) }}"
      enctype="multipart/form-data">
@csrf

<input type="hidden" name="photo" id="photoInput">

<div class="grid md:grid-cols-2 gap-6">

    <!-- CAMERA -->
    <div class="text-center">
        <video id="video" class="w-full rounded border" autoplay></video>

        <button type="button"
                onclick="capturePhoto()"
                class="mt-3 px-4 py-2 bg-blue-600 text-white rounded">
            Capture Photo
        </button>
    </div>

    <!-- PREVIEW -->
    <div class="text-center">
        <canvas id="canvas" class="hidden"></canvas>

        <img id="preview"
             class="w-48 h-48 mx-auto rounded-full border hidden">

        <p class="mt-2 text-sm text-gray-600">
            Preview
        </p>
    </div>
</div>

<hr class="my-6">

<!-- UPLOAD OPTION -->
<div>
    <label class="block font-semibold mb-2">
        Or Upload Photo
    </label>
    <input type="file"
           name="photo"
           accept="image/*"
           class="border rounded p-2 w-full">
</div>

<div class="mt-6 flex justify-end">
    <button class="px-6 py-2 bg-green-600 text-white rounded">
        Save Photo
    </button>
</div>

</form>

</div>
</div>

<script>
const video = document.getElementById('video');
const canvas = document.getElementById('canvas');
const preview = document.getElementById('preview');
const photoInput = document.getElementById('photoInput');

navigator.mediaDevices.getUserMedia({ video: true })
    .then(stream => video.srcObject = stream)
    .catch(err => alert('Camera access denied'));

function capturePhoto() {
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;

    canvas.getContext('2d')
          .drawImage(video, 0, 0);

    const imageData = canvas.toDataURL('image/png');
    photoInput.value = imageData;

    preview.src = imageData;
    preview.classList.remove('hidden');
}
</script>

</x-app-layout>
