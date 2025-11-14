@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto mt-8">

    @if(session('success'))
        <div class="bg-green-500 text-white p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-between mb-4">
        <h1 class="text-2xl font-bold">Values for "{{ $attribute->name }}"</h1>
        <a href="{{ route('admin.values.create', $attribute->id) }}" 
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
           + Add Value
        </a>
    </div>

    <div class="bg-white shadow rounded">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-3">Value</th>
                    <th class="p-3 text-right">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($values as $value)
                <tr class="border-b">
                    <td class="p-3">{{ $value->value }}</td>
                    <td class="p-3 text-right">
                        <a href="{{ route('admin.values.edit', [$attribute->id, $value->id]) }}"
                           class="text-blue-600 mr-4">Edit</a>

                        <form action="{{ route('admin.values.destroy', [$attribute->id, $value->id]) }}"
                              method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button 
                                onclick="return confirm('Delete this value?')"
                                class="text-red-600">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="2" class="p-3 text-center">No values found</td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>

    <a href="{{ route('admin.attributes.index') }}" class="mt-4 inline-block text-blue-600">← Back to Attributes</a>

</div>
@endsection
