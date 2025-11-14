@extends('layouts.admin')

@section('content')
<div class="p-6 bg-white rounded shadow">
    <h2 class="text-xl font-semibold mb-6">Edit Banner</h2>

    <form action="{{ route('admin.banners.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Title -->
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-1">Title</label>
            <input type="text" name="title" value="{{ old('title', $category->title) }}" 
                   class="w-full border rounded px-3 py-2">
        </div>

        <!-- Subtitle -->
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-1">Subtitle</label>
            <input type="text" name="subtitle" value="{{ old('subtitle', $category->subtitle) }}" 
                   class="w-full border rounded px-3 py-2">
        </div>

        <!-- Button Text -->
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-1">Button Text</label>
            <input type="text" name="button_text" value="{{ old('button_text', $category->button_text) }}" 
                   class="w-full border rounded px-3 py-2">
        </div>

        <!-- Button Link -->
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-1">Button Link</label>
            <input type="text" name="button_link" value="{{ old('button_link', $category->button_link) }}" 
                   class="w-full border rounded px-3 py-2">
        </div>

        <!-- Banner Image with Preview -->
         <!-- Banner Image with Preview -->
<div class="mb-4">
    <label class="block text-gray-700 font-medium mb-1">Banner Image</label>
    <input type="file" name="image" class="w-full border rounded p-2" id="imageInput">

    <div class="mt-2">
        @if(!empty($category->image))
            <img id="previewImage" src="{{ asset($category->image) }}" 
                 class="w-full max-w-screen-xl h-64 md:h-96 object-cover rounded shadow">
        @else
            <img id="previewImage" class="w-full max-w-screen-xl h-64 md:h-96 object-cover rounded shadow hidden">
        @endif
    </div>
</div>



        <!-- Submit Button -->
        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
            Update
        </button>
    </form>
</div>

<!-- JS for Live Preview -->
<script>
    const imageInput = document.getElementById('imageInput');
    const preview = document.getElementById('previewImage');

    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if(file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                preview.src = event.target.result;
                preview.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
