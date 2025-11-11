@extends('layouts.admin')

@section('title', 'Product Details')

@section('content')
    <div class="p-6">
        <!-- Page header -->
        <div class="mb-8">
            <div class="sm:flex sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900">Product Details</h1>
                    <p class="mt-1 text-sm text-gray-600">View product information</p>
                </div>
                <div class="mt-4 sm:mt-0 flex gap-3">
                    <a href="{{ route('admin.products.edit', $product) }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                        Edit
                    </a>
                    <a href="{{ route('admin.products.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Product Images -->
            <div class="lg:col-span-1">
                <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl p-6">
                    <h2 class="text-lg font-semibold leading-7 text-gray-900 mb-4">Product Images</h2>

                    @if (!empty($product->images))
                        <div class="space-y-4">
                            <!-- Main Image -->
                            <div class="aspect-square rounded-lg overflow-hidden">
                                <img src="{{ $product->main_image }}" alt="{{ $product->name }}"
                                    class="w-full h-full object-cover">
                            </div>

                            <!-- Additional Images -->
                            @if (count($product->image_urls) > 1)
                                <div class="grid grid-cols-3 gap-2">
                                    @foreach (array_slice($product->image_urls, 1) as $imageUrl)
                                        <div class="aspect-square rounded-lg overflow-hidden">
                                            <img src="{{ $imageUrl }}" alt="{{ $product->name }}"
                                                class="w-full h-full object-cover">
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="aspect-square rounded-lg bg-gray-100 flex items-center justify-center">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <p class="text-center text-gray-500 mt-2">No images available</p>
                    @endif
                </div>
            </div>

            <!-- Product Details -->
            <div class="lg:col-span-2">
                <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl p-6 space-y-8">

                    <!-- Basic Information -->
                    <div>
                        <h2 class="text-lg font-semibold leading-7 text-gray-900 mb-4">Basic Information</h2>
                        <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Product Name</dt>
                                <dd class="text-sm text-gray-900">{{ $product->name }}</dd>
                            </div>

                            @if ($product->name_en)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">English Name</dt>
                                    <dd class="text-sm text-gray-900">{{ $product->name_en }}</dd>
                                </div>
                            @endif

                            <div>
                                <dt class="text-sm font-medium text-gray-500">Slug</dt>
                                <dd class="text-sm text-gray-900 font-mono">{{ $product->slug }}</dd>
                            </div>

                            <div>
                                <dt class="text-sm font-medium text-gray-500">SKU</dt>
                                <dd class="text-sm text-gray-900 font-mono">{{ $product->sku }}</dd>
                            </div>

                            @if ($product->category)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Category</dt>
                                    <dd class="text-sm text-gray-900">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            {{ $product->category->name }}
                                        </span>
                                    </dd>
                                </div>
                            @endif

                            <div>
                                <dt class="text-sm font-medium text-gray-500">Sort Order</dt>
                                <dd class="text-sm text-gray-900">{{ $product->sort_order }}</dd>
                            </div>
                        </dl>
                    </div>

                    <!-- Pricing -->
                    <div class="border-t border-gray-200 pt-6">
                        <h2 class="text-lg font-semibold leading-7 text-gray-900 mb-4">Pricing</h2>
                        <dl class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Selling Price</dt>
                                <dd class="text-lg font-semibold text-gray-900">{{ $product->formatted_price }}</dd>
                            </div>

                            @if ($product->compare_price)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Compare Price</dt>
                                    <dd class="text-sm text-gray-500 line-through">{{ $product->formatted_compare_price }}
                                    </dd>
                                    @if ($product->discount_percentage > 0)
                                        <dd class="text-xs text-green-600 font-medium">{{ $product->discount_percentage }}%
                                            off</dd>
                                    @endif
                                </div>
                            @endif

                            @if ($product->cost_price)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Cost Price</dt>
                                    <dd class="text-sm text-gray-900">@bdt($product->cost_price)</dd>
                                </div>
                            @endif
                        </dl>
                    </div>

                    <!-- Variants -->
                    @if ($product->variants->count())
                        <div class="border-t border-gray-200 pt-6">
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
                                            <th class="px-4 py-2 text-left font-medium text-gray-700">Image</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @foreach ($product->variants as $variant)
                                            <tr>
                                                <td class="px-4 py-2">{{ $variant->sku }}</td>

                                                @foreach ($attributes as $attribute)
                                                    @php
                                                        $value = $variant->values->firstWhere(
                                                            'attribute_id',
                                                            $attribute->id,
                                                        );
                                                    @endphp
                                                    <td class="px-4 py-2">
                                                        {{ $value?->attributeValue?->value ?? '-' }}
                                                    </td>
                                                @endforeach

                                                <td class="px-4 py-2">৳{{ number_format($variant->price, 2) }}</td>
                                                <td class="px-4 py-2">{{ $variant->stock }}</td>
                                                <td class="px-4 py-2">
                                                    @if ($variant->image)
                                                        <img src="{{ asset('storage/' . $variant->image) }}"
                                                            alt="Variant Image" class="w-12 h-12 object-cover rounded">
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif


                    <!-- Inventory -->
                    <div class="border-t border-gray-200 pt-6">
                        <h2 class="text-lg font-semibold leading-7 text-gray-900 mb-4">Inventory</h2>
                        <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Stock Status</dt>
                                <dd class="mt-1">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $product->stock_status_color }}">
                                        {{ $product->stock_status }}
                                    </span>
                                </dd>
                            </div>

                            <div>
                                <dt class="text-sm font-medium text-gray-500">Stock Quantity</dt>
                                <dd class="text-sm text-gray-900">
                                    {{ $product->stock_quantity }}
                                    @if (!$product->track_stock)
                                        <span class="text-gray-500">(Not tracked)</span>
                                    @endif
                                </dd>
                            </div>
                        </dl>
                    </div>

                    <!-- Status -->
                    <div class="border-t border-gray-200 pt-6">
                        <h2 class="text-lg font-semibold leading-7 text-gray-900 mb-4">Status</h2>
                        <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Visibility</dt>
                                <dd class="mt-1">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $product->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $product->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </dd>
                            </div>

                            <div>
                                <dt class="text-sm font-medium text-gray-500">Featured</dt>
                                <dd class="mt-1">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $product->is_featured ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ $product->is_featured ? 'Featured' : 'Regular' }}
                                    </span>
                                </dd>
                            </div>
                        </dl>
                    </div>

                    <!-- Descriptions -->
                    @if ($product->short_description || $product->description || $product->description_en)
                        <div class="border-t border-gray-200 pt-6">
                            <h2 class="text-lg font-semibold leading-7 text-gray-900 mb-4">Description</h2>
                            <div class="space-y-4">
                                @if ($product->short_description)
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500 mb-1">Short Description</dt>
                                        <dd class="text-sm text-gray-900">{{ $product->short_description }}</dd>
                                    </div>
                                @endif

                                @if ($product->description)
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500 mb-1">Description</dt>
                                        <dd class="text-sm text-gray-900 whitespace-pre-wrap">{{ $product->description }}
                                        </dd>
                                    </div>
                                @endif

                                @if ($product->description_en)
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500 mb-1">English Description</dt>
                                        <dd class="text-sm text-gray-900 whitespace-pre-wrap">
                                            {{ $product->description_en }}</dd>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Physical Properties -->
                    @if ($product->weight || $product->dimensions)
                        <div class="border-t border-gray-200 pt-6">
                            <h2 class="text-lg font-semibold leading-7 text-gray-900 mb-4">Physical Properties</h2>
                            <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @if ($product->weight)
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Weight</dt>
                                        <dd class="text-sm text-gray-900">{{ $product->weight }} kg</dd>
                                    </div>
                                @endif

                                @if ($product->dimensions)
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Dimensions</dt>
                                        <dd class="text-sm text-gray-900">{{ $product->dimensions }}</dd>
                                    </div>
                                @endif
                            </dl>
                        </div>
                    @endif

                    <!-- SEO -->
                    @if ($product->meta_title || $product->meta_description)
                        <div class="border-t border-gray-200 pt-6">
                            <h2 class="text-lg font-semibold leading-7 text-gray-900 mb-4">SEO</h2>
                            <div class="space-y-4">
                                @if ($product->meta_title)
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500 mb-1">Meta Title</dt>
                                        <dd class="text-sm text-gray-900">{{ $product->meta_title }}</dd>
                                    </div>
                                @endif

                                @if ($product->meta_description)
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500 mb-1">Meta Description</dt>
                                        <dd class="text-sm text-gray-900">{{ $product->meta_description }}</dd>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Timestamps -->
                    <div class="border-t border-gray-200 pt-6">
                        <h2 class="text-lg font-semibold leading-7 text-gray-900 mb-4">Timestamps</h2>
                        <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Created</dt>
                                <dd class="text-sm text-gray-900">{{ $product->created_at->format('d M, Y - h:i A') }}
                                </dd>
                            </div>

                            <div>
                                <dt class="text-sm font-medium text-gray-500">Last Updated</dt>
                                <dd class="text-sm text-gray-900">{{ $product->updated_at->format('d M, Y - h:i A') }}
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
