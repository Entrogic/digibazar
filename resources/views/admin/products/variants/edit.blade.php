@extends('layouts.admin')

@section('content')
    <div class="max-w-8xl mx-auto p-6 bg-white rounded-2xl shadow">
        <h2 class="text-2xl font-semibold mb-6 flex items-center gap-2">✏️ Edit Product Variant</h2>

        <form action="{{ route('admin.product.variants.update', [$product->id, $variant->id]) }}" method="POST"
            enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Product Info -->
            <div class="bg-gray-50 p-4 rounded-xl border">
                <h3 class="text-lg font-medium mb-3">Base Product</h3>
                <p class="text-gray-700">{{ $product->name }}</p>
                <p class="text-gray-500 text-sm">Base Price: ৳{{ number_format($product->price, 2) }}</p>
            </div>

            <!-- Variant Edit Form -->
            <div class="border p-4 rounded-xl space-y-4 bg-gray-50">
                <!-- Attribute Selects -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    @foreach ($attributes as $attribute)
                        @php
                            $selectedValue = $variant->values->firstWhere('attribute_id', $attribute->id)?->attribute_value_id;
                        @endphp
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">{{ $attribute->name }}</label>
                            <select name="attributes[{{ $attribute->id }}]"
                                class="w-full border rounded-xl px-3 py-2 focus:ring-2 focus:ring-blue-500">
                                <option value="">Select {{ $attribute->name }}</option>
                                @foreach ($attribute->values as $value)
                                    <option value="{{ $value->id }}"
                                        {{ $selectedValue == $value->id ? 'selected' : '' }}>
                                        {{ $value->value }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endforeach
                </div>

                <!-- Price & Stock -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Variant Price (৳)</label>
                        <input type="number" name="price" step="0.01" value="{{ $variant->price }}"
                            class="w-full border rounded-xl px-3 py-2 focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Stock Quantity</label>
                        <input type="number" name="stock" value="{{ $variant->stock }}"
                            class="w-full border rounded-xl px-3 py-2 focus:ring-2 focus:ring-blue-500" required>
                    </div>
                </div>

                <!-- Image -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Variant Image</label>
                    @if ($variant->image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $variant->image) }}" alt="Variant Image"
                                class="h-20 w-20 object-cover rounded-lg border">
                        </div>
                    @endif
                    <input type="file" name="image"
                        class="w-full border rounded-xl px-3 py-2 focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <!-- Submit -->
            <div class="pt-4 text-right flex justify-between">
                <a href="{{ route('admin.product.variants.create', $product->id) }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-xl font-medium transition">
                    Cancel
                </a>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl font-medium transition">
                    Update Variant
                </button>
            </div>
        </form>
    </div>
@endsection
