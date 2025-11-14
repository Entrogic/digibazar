@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto bg-white dark:bg-neutral-800 shadow-md rounded-2xl p-8 mt-10">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">Create New Banner</h2>

    <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf

        {{-- Title --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Title</label>
            <input type="text" name="title" value="{{ old('title') }}" 
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-neutral-700 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            @error('title') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Subtitle --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Subtitle</label>
            <input type="text" name="subtitle" value="{{ old('subtitle') }}" 
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-neutral-700 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            @error('subtitle') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Button Text --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Button Text</label>
            <input type="text" name="button_text" value="{{ old('button_text') }}" 
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-neutral-700 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            @error('button_text') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Button Link --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Button Link</label>
            <input type="text" name="button_link" value="{{ old('button_link') }}" 
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-neutral-700 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            @error('button_link') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Image Upload --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Banner Image</label>
            <input type="file" name="image" id="imageInput"
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-neutral-700 focus:ring-2 focus:ring-blue-500 focus:outline-none">

            {{-- Image Preview --}}
            <div class="mt-3">
                <img id="imagePreview" src="#" alt="Preview" class="hidden w-full max-h-60 object-cover rounded-lg border border-gray-300 dark:border-gray-600">
            </div>
            
            @error('image') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Status --}}
        <div class="flex items-center space-x-2">
            <input type="checkbox" name="status" value="1" checked 
                class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
            <label class="text-sm text-gray-700 dark:text-gray-200">Active</label>
        </div>

        {{-- Submit --}}
        <div class="flex justify-end">
            <button type="submit" 
                class="px-6 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition">
                Save Banner
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $('#imageInput').on('change', function (e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (event) {
                $('#imagePreview').attr('src', event.target.result).removeClass('hidden');
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush
