@extends('layouts.admin')

@section('title', 'Create New Product')

@section('content')
    <div class="p-6">
        <!-- Page header -->
        <div class="mb-8">
            <div class="sm:flex sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900">Create New Product</h1>
                    <p class="mt-1 text-sm text-gray-600">Fill in the details for the new product</p>
                </div>
                <div class="mt-4 sm:mt-0">
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

        <!-- Create Form -->
        <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data"
                class="p-6 space-y-6">
                @csrf

                <!-- Basic Information -->
                <div class="border-b border-gray-900/10 pb-6">
                    <h2 class="text-lg font-semibold leading-7 text-gray-900">Basic Information</h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600">Essential product details</p>

                    <div class="mt-6 grid grid-cols-1 gap-6 lg:grid-cols-2">
                        <!-- Product Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                Product Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 @error('name') ring-red-500 @enderror"
                                placeholder="Enter product name" required>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- English Name -->
                        <div>
                            <label for="name_en" class="block text-sm font-medium text-gray-700 mb-2">
                                English Name
                            </label>
                            <input type="text" name="name_en" id="name_en" value="{{ old('name_en') }}"
                                class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 @error('name_en') ring-red-500 @enderror"
                                placeholder="English name (optional)">
                            @error('name_en')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Slug -->
                        <div>
                            <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">
                                Slug
                            </label>
                            <input type="text" name="slug" id="slug" value="{{ old('slug') }}"
                                class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 @error('slug') ring-red-500 @enderror"
                                placeholder="URL-friendly name (optional)">
                            <p class="mt-1 text-xs text-gray-500">Leave empty to auto-generate from name</p>
                            @error('slug')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">
                                Category
                            </label>
                            <select name="category_id" id="category_id"
                                class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 @error('category_id') ring-red-500 @enderror">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Unit -->
                        <div>
                            <label for="unit_id" class="block text-sm font-medium text-gray-700 mb-2">
                                Unit
                            </label>
                            <select name="unit_id" id="unit_id"
                                class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 @error('unit_id') ring-red-500 @enderror">
                                <option value="">Select Unit</option>
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}"
                                        {{ old('unit_id') == $unit->id ? 'selected' : '' }}>
                                        {{ $unit->name }} ({{ $unit->symbol }})
                                    </option>
                                @endforeach
                            </select>
                            @error('unit_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>



                        <!-- SKU -->
                        <div>
                            <label for="sku" class="block text-sm font-medium text-gray-700 mb-2">
                                SKU
                            </label>
                            <input type="text" name="sku" id="sku" value="{{ old('sku') }}"
                                class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 @error('sku') ring-red-500 @enderror"
                                placeholder="Stock Keeping Unit (optional)">
                            <p class="mt-1 text-xs text-gray-500">Leave empty to auto-generate</p>
                            @error('sku')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Sort Order -->
                        <div>
                            <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">
                                Sort Order
                            </label>
                            <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', 0) }}"
                                min="0"
                                class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 @error('sort_order') ring-red-500 @enderror">
                            @error('sort_order')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Pricing -->
                <div class="border-b border-gray-900/10 pb-6">
                    <h2 class="text-lg font-semibold leading-7 text-gray-900">Pricing</h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600">Set product pricing information</p>

                    <div class="mt-6 grid grid-cols-1 gap-6 lg:grid-cols-3">
                        <!-- Price -->
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-2">
                                Price (BDT) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="price" id="price" value="{{ old('price') }}" min="0"
                                step="0.01"
                                class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 @error('price') ring-red-500 @enderror"
                                placeholder="0.00" required>
                            @error('price')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Compare Price -->
                        <div>
                            <label for="compare_price" class="block text-sm font-medium text-gray-700 mb-2">
                                Compare Price (BDT)
                            </label>
                            <input type="number" name="compare_price" id="compare_price"
                                value="{{ old('compare_price') }}" min="0" step="0.01"
                                class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 @error('compare_price') ring-red-500 @enderror"
                                placeholder="0.00">
                            <p class="mt-1 text-xs text-gray-500">Original price for discount calculation</p>
                            @error('compare_price')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Cost Price -->
                        <div>
                            <label for="cost_price" class="block text-sm font-medium text-gray-700 mb-2">
                                Cost Price (BDT)
                            </label>
                            <input type="number" name="cost_price" id="cost_price" value="{{ old('cost_price') }}"
                                min="0" step="0.01"
                                class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 @error('cost_price') ring-red-500 @enderror"
                                placeholder="0.00">
                            <p class="mt-1 text-xs text-gray-500">Your cost for this product</p>
                            @error('cost_price')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>


                <!-- Inventory -->
                <div class="border-b border-gray-900/10 pb-6">
                    <h2 class="text-lg font-semibold leading-7 text-gray-900">Inventory</h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600">Manage stock and inventory</p>

                    <div class="mt-6 grid grid-cols-1 gap-6 lg:grid-cols-2">
                        <!-- Stock Quantity -->
                        <div>
                            <label for="min_qty" class="block text-sm font-medium text-gray-700 mb-2">
                                Minimum Quantity <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="min_qty" id="min_qty" value="{{ old('min_qty', 0) }}"
                                min="0"
                                class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 @error('min_qty') ring-red-500 @enderror"
                                required>
                            @error('min_qty')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="stock_quantity" class="block text-sm font-medium text-gray-700 mb-2">
                                Stock Quantity <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="stock_quantity" id="stock_quantity"
                                value="{{ old('stock_quantity', 0) }}" min="0"
                                class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 @error('stock_quantity') ring-red-500 @enderror"
                                required>
                            @error('stock_quantity')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Track Stock -->
                        <div class="flex items-center mt-8">
                            <input type="checkbox" name="track_stock" id="track_stock" value="1"
                                {{ old('track_stock', true) ? 'checked' : '' }}
                                class="h-4 w-4 text-blue-600 focus:ring-blue-600 border-gray-300 rounded">
                            <label for="track_stock" class="ml-2 block text-sm text-gray-900">
                                Track stock quantity
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="border-b border-gray-900/10 pb-6">
                    <h2 class="text-lg font-semibold leading-7 text-gray-900">Description</h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600">Product description and details</p>

                    <div class="mt-6 space-y-6">
                        <!-- Short Description -->
                        <div>
                            <label for="short_description" class="block text-sm font-medium text-gray-700 mb-2">
                                Short Description
                            </label>
                            <textarea name="short_description" id="short_description" rows="2"
                                class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 @error('short_description') ring-red-500 @enderror"
                                placeholder="Brief product description">{{ old('short_description') }}</textarea>
                            @error('short_description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                Description
                            </label>
                            <textarea name="description" id="description" rows="4"
                                class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 @error('description') ring-red-500 @enderror"
                                placeholder="Enter detailed product description">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- English Description -->
                        <div>
                            <label for="description_en" class="block text-sm font-medium text-gray-700 mb-2">
                                English Description
                            </label>
                            <textarea name="description_en" id="description_en" rows="4"
                                class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 @error('description_en') ring-red-500 @enderror"
                                placeholder="English description (optional)">{{ old('description_en') }}</textarea>
                            @error('description_en')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Images -->
                <div class="border-b border-gray-900/10 pb-6">
                    <h2 class="text-lg font-semibold leading-7 text-gray-900">Product Images</h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600">Upload product images</p>

                    <div class="mt-6">
                        <div
                            class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                            <div class="text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-300" stroke="currentColor" fill="none"
                                    viewBox="0 0 48 48">
                                    <path
                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="mt-4 flex text-sm leading-6 text-gray-600">
                                    <label for="images"
                                        class="relative cursor-pointer rounded-md bg-white font-semibold text-blue-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-blue-600 focus-within:ring-offset-2 hover:text-blue-500">
                                        <span>Upload files</span>
                                        <input id="images" name="images[]" type="file" class="sr-only"
                                            accept="image/*" multiple>
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF up to 2MB each</p>
                            </div>
                        </div>
                        @error('images.*')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Physical Properties -->
                <div class="border-b border-gray-900/10 pb-6">
                    <h2 class="text-lg font-semibold leading-7 text-gray-900">Physical Properties</h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600">Weight and dimensions</p>

                    <div class="mt-6 grid grid-cols-1 gap-6 lg:grid-cols-2">
                        <!-- Weight -->
                        <div>
                            <label for="weight" class="block text-sm font-medium text-gray-700 mb-2">
                                Weight (kg)
                            </label>
                            <input type="number" name="weight" id="weight" value="{{ old('weight') }}"
                                min="0" step="0.01"
                                class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 @error('weight') ring-red-500 @enderror"
                                placeholder="0.00">
                            @error('weight')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Dimensions -->
                        <div>
                            <label for="dimensions" class="block text-sm font-medium text-gray-700 mb-2">
                                Dimensions
                            </label>
                            <input type="text" name="dimensions" id="dimensions" value="{{ old('dimensions') }}"
                                class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 @error('dimensions') ring-red-500 @enderror"
                                placeholder="Length x Width x Height">
                            @error('dimensions')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- SEO -->
                <div class="border-b border-gray-900/10 pb-6">
                    <h2 class="text-lg font-semibold leading-7 text-gray-900">SEO</h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600">Search engine optimization</p>

                    <div class="mt-6 space-y-6">
                        <!-- Meta Title -->
                        <div>
                            <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-2">
                                Meta Title
                            </label>
                            <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title') }}"
                                class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 @error('meta_title') ring-red-500 @enderror"
                                placeholder="SEO title for search engines">
                            @error('meta_title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Meta Description -->
                        <div>
                            <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-2">
                                Meta Description
                            </label>
                            <textarea name="meta_description" id="meta_description" rows="3"
                                class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 @error('meta_description') ring-red-500 @enderror"
                                placeholder="SEO description for search engines">{{ old('meta_description') }}</textarea>
                            @error('meta_description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Status -->
                <div class="pb-6">
                    <h2 class="text-lg font-semibold leading-7 text-gray-900">Status</h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600">Product visibility and featured status</p>

                    <div class="mt-6 space-y-4">
                        <!-- Active Status -->
                        <div class="flex items-center">
                            <input type="checkbox" name="is_active" id="is_active" value="1"
                                {{ old('is_active', true) ? 'checked' : '' }}
                                class="h-4 w-4 text-blue-600 focus:ring-blue-600 border-gray-300 rounded">
                            <label for="is_active" class="ml-2 block text-sm text-gray-900">
                                Product is active and visible
                            </label>
                        </div>

                        <!-- Featured Status -->
                        <div class="flex items-center">
                            <input type="checkbox" name="is_featured" id="is_featured" value="1"
                                {{ old('is_featured') ? 'checked' : '' }}
                                class="h-4 w-4 text-blue-600 focus:ring-blue-600 border-gray-300 rounded">
                            <label for="is_featured" class="ml-2 block text-sm text-gray-900">
                                Mark as featured product
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex items-center justify-end gap-x-6 pt-6 border-t border-gray-900/10">
                    <a href="{{ route('admin.products.index') }}"
                        class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
                    <button type="submit"
                        class="rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                        Create Product
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Auto-generate slug from name
        document.getElementById('name').addEventListener('input', function() {
            const nameInput = this.value;
            const slugInput = document.getElementById('slug');

            if (slugInput.value === '') {
                const slug = nameInput.toLowerCase()
                    .replace(/[^\u0980-\u09FF\w\s-]/g, '') // Keep Bengali, alphanumeric, spaces, hyphens
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-')
                    .trim('-');
                slugInput.value = slug;
            }
        });

        // Image preview
        document.getElementById('images').addEventListener('change', function(e) {
            const files = e.target.files;
            if (files.length > 0) {
                console.log(`Selected ${files.length} image(s)`);
                // You can add image preview functionality here
            }
        });
    </script>
@endsection
