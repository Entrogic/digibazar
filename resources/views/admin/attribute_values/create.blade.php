@extends('layouts.admin')

@section('content')
<div class="max-w-lg mx-auto mt-10 bg-white shadow p-6 rounded">

    <h1 class="text-xl font-bold mb-4">Add Value to "{{ $attribute->name }}"</h1>

    <form method="POST" action="{{ route('admin.values.store', $attribute->id) }}">
        @csrf

        <label class="block mb-2 font-semibold">Value</label>
        <input type="text" name="value" value="{{ old('value') }}"
               class="w-full border p-2 rounded focus:ring focus:ring-blue-300">

        @error('value')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror

        <button 
            class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Save
        </button>
    </form>

    <a href="{{ route('admin.values.index', $attribute->id) }}" class="mt-4 inline-block text-blue-600">← Back to Values</a>
</div>
@endsection
