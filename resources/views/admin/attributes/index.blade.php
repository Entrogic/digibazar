@extends('layouts.admin')

@section('content')
    <div class="max-w-7xl mx-auto mt-8">

        @if (session('success'))
            <div class="bg-green-500 text-white p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex justify-between mb-4">
            <h1 class="text-2xl font-bold">Attributes</h1>
            <a href="{{ route('admin.attributes.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Add Attribute
            </a>
        </div>

        <div class="bg-white shadow rounded">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="p-3">Name</th>
                        <th class="p-3">Slug</th>
                        <th class="p-3 text-right">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($attributes as $attribute)
                        <tr class="border-b">
                            <td class="p-3">{{ $attribute->name }}</td>
                            <td class="p-3">{{ $attribute->slug }}</td>
                            <td class="p-3 text-right">
                                <!-- Go to Values button -->
                                <a href="{{ route('admin.values.index', $attribute->id) }}"
                                    class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 mr-4">
                                    Values
                                </a>
                                <a href="{{ route('admin.attributes.edit', $attribute->id) }}"
                                    class="text-blue-600 mr-4">Edit</a>

                                <form action="{{ route('admin.attributes.destroy', $attribute->id) }}" method="POST"
                                    class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Delete this attribute?')" class="text-red-600">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="p-3 text-center">No attributes found</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

    </div>
@endsection
