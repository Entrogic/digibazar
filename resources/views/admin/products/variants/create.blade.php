@extends('layouts.admin')

@section('content')
    <div class="max-w-8xl mx-auto p-6 bg-white rounded-2xl shadow">
        <h2 class="text-2xl font-semibold mb-6 flex items-center gap-2">➕ Add Product Variants</h2>

        <form action="{{ route('admin.product.variants.store', $product->id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-6" id="variantForm">
            @csrf

            <!-- Product Info -->
            <div class="bg-gray-50 p-4 rounded-xl border">
                <h3 class="text-lg font-medium mb-3">Base Product</h3>
                <p class="text-gray-700">{{ $product->name }}</p>
                <p class="text-gray-500 text-sm">Base Price: ৳{{ number_format($product->base_price, 2) }}</p>
            </div>

            <!-- Variants -->
            @if ($product->variants->count())
                <div class="border-t border p-4 pt-6">
                    <h2 class="text-lg font-semibold leading-7 text-gray-900 mb-4">Product Variants</h2>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 text-left font-medium text-gray-700">SKU</th>
                                    @foreach ($attributes as $attribute)
                                        <th class="px-4 py-2 text-left font-medium text-gray-700">
                                            {{ $attribute->name }}</th>
                                    @endforeach
                                    <th class="px-4 py-2 text-left font-medium text-gray-700">Price</th>
                                    <th class="px-4 py-2 text-left font-medium text-gray-700">Stock</th>
                                    <th class="px-4 py-2 text-left font-medium text-gray-700">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($product->variants as $variant)
                                    <tr>
                                        <td class="px-4 py-2">{{ $variant->sku }}</td>

                                        @foreach ($attributes as $attribute)
                                            @php
                                                $value = $variant->values->firstWhere('attribute_id', $attribute->id);
                                            @endphp
                                            <td class="px-4 py-2">
                                                {{ $value?->attributeValue?->value ?? '-' }}
                                            </td>
                                        @endforeach

                                        <td class="px-4 py-2">৳{{ number_format($variant->price, 2) }}</td>
                                        <td class="px-4 py-2">{{ $variant->stock }}</td>
                                        <td class="px-4 py-2 text-red-600">
                                          <i class="fa fa-trash"></i>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            <!-- Variant Rows Wrapper -->
            <div id="variantRows">
                <div class="variant-row border p-4 rounded-xl space-y-4 bg-gray-50 relative mb-4">
                    <button type="button"
                        class="removeRow absolute top-2 right-2 text-red-500 font-bold text-lg">&times;</button>

                    <!-- Attribute Selects -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        @foreach ($attributes as $attribute)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">{{ $attribute->name }}</label>
                                <select name="attributes[0][{{ $attribute->id }}]"
                                    class="w-full border rounded-xl px-3 py-2 focus:ring-2 focus:ring-blue-500">
                                    <option value="">Select {{ $attribute->name }}</option>
                                    @foreach ($attribute->values as $value)
                                        <option value="{{ $value->id }}">{{ $value->value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endforeach
                    </div>

                    <!-- Price & Stock -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Variant Price (৳)</label>
                            <input type="number" name="price[0]" step="0.01"
                                class="w-full border rounded-xl px-3 py-2 focus:ring-2 focus:ring-blue-500" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Stock Quantity</label>
                            <input type="number" name="stock[0]"
                                class="w-full border rounded-xl px-3 py-2 focus:ring-2 focus:ring-blue-500" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add Variant Button -->
            <div>
                <button type="button" id="addVariantRow"
                    class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-xl font-medium transition">
                    + Add Another Variant
                </button>
            </div>

            <!-- Submit -->
            <div class="pt-4 text-right">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl font-medium transition">
                    Save All Variants
                </button>
            </div>
        </form>
    </div>

    <!-- jQuery -->


@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            let variantIndex = 1;

            // Add new variant row
            $('#addVariantRow').click(function() {
                let newRow = $('.variant-row:first').clone();
                newRow.find('input, select').each(function() {
                    let name = $(this).attr('name');
                    name = name.replace(/\d+/, variantIndex); // replace index
                    $(this).attr('name', name).val('');
                });
                $('#variantRows').append(newRow);
                variantIndex++;
            });

            // Remove row
            $(document).on('click', '.removeRow', function() {
                if ($('.variant-row').length > 1) {
                    $(this).closest('.variant-row').remove();
                }
            });
        });
    </script>
@endpush
