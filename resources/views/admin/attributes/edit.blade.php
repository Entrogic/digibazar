@extends('layouts.admin')

@section('content')
<div class="max-w-lg mx-auto mt-10 bg-white shadow p-6 rounded">

    <h1 class="text-xl font-bold mb-4">Edit Attribute</h1>

    <form method="POST" action="{{ route('admin.attributes.update', $attribute->id) }}">
        @csrf
        @method('PUT')

        <label class="block mb-2 font-semibold">Name</label>
        <input type="text" name="name" value="{{ $attribute->name }}"
               class="w-full border p-2 rounded focus:ring focus:ring-blue-300">

        @error('name')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror

        <button 
            class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Update
        </button>
    </form>

</div>
@endsection
