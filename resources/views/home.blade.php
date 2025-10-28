@extends('layouts.app')
@section('content')
    <!-- Hero Section -->
    <section class="hero-bg py-32 text-center text-white">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                {{ \App\Models\Setting::get('site_tagline', 'মুদি থেকে উৎস — সবকিছু পৌঁছে যাবে আপনার দরজায়') }}
            </h1>
            <p class="text-lg mb-8 text-gray-200">
                {{ \App\Models\Setting::get('site_description', 'কাজকর্মে ব্যস্ততার মাঝে সময় বাঁচান') }}
            </p>
            <button
                class="bg-green-500 hover:bg-green-600 text-white px-8 py-3 rounded-full font-semibold inline-flex items-center space-x-2 transition">
                <span>এখনই কিনুন</span>
                <span>→</span>
            </button>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="flex items-start space-x-4">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center text-3xl flex-shrink-0">
                        ⏱️
                    </div>
                    <div>
                        <h3 class="font-bold text-lg mb-2">১ ঘণ্টায় নয়া ডেলিভারি</h3>
                        <p class="text-gray-600">সময়মত অর্ডার ডেলিভারি পাবার সময়</p>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="flex items-start space-x-4">
                    <div
                        class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center text-3xl flex-shrink-0">
                        🥬
                    </div>
                    <div>
                        <h3 class="font-bold text-lg mb-2">তাজা ও আসল পণ্য</h3>
                        <p class="text-gray-600">প্রতিটি খাবার পরামাণবিক মান যাচাই</p>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="flex items-start space-x-4">
                    <div
                        class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center text-3xl flex-shrink-0">
                        💰
                    </div>
                    <div>
                        <h3 class="font-bold text-lg mb-2">সাশ্রয়ী দাম</h3>
                        <p class="text-gray-600">বাজারের তুলনায়, একদম কম দামে</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-4">জনপ্রিয় ক্যাটাগরি</h2>
            <p class="text-center text-gray-600 mb-12">যে বিষয়গুলি পরিলক্ষ, প্রায় শতাংশের ন্যস আমরা:</p>

            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-8 gap-4">
                <!-- Category 1 -->
                @foreach ($categories as $item)
                    <div class="bg-green-100 rounded-lg p-6 text-center hover:shadow-lg transition cursor-pointer">
                        <div class="text-4xl mb-2">{{ $item->image ?? '🥬' }}</div>
                        <p class="font-semibold">{{ $item->name }}</p>
                    </div>
                @endforeach


            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-4">বিশেষ অফার পণ্য</h2>
            <p class="text-center text-gray-600 mb-12">আমাদের সেরা ও জনপ্রিয় পণ্যসমূহ দেখুন</p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($featuredProducts as $product)
                    <div
                        class="bg-white rounded-lg shadow-md hover:shadow-lg transition duration-300 overflow-hidden border">
                        <!-- Product Image -->
                        <div class="relative">
                            <img src="{{ $product->main_image }}" alt="{{ $product->name }}"
                                class="w-full h-48 object-cover">

                            @if ($product->is_featured)
                                <span
                                    class="absolute top-2 left-2 bg-yellow-500 text-white text-xs px-2 py-1 rounded-full font-semibold">
                                    বিশেষ
                                </span>
                            @endif

                            @if ($product->discount_percentage > 0)
                                <span
                                    class="absolute top-2 right-2 bg-red-500 text-white text-xs px-2 py-1 rounded-full font-semibold">
                                    {{ $product->discount_percentage }}% ছাড়
                                </span>
                            @endif
                        </div>

                        <!-- Product Info -->
                        <div class="p-4">
                            <h3 class="font-semibold text-lg mb-2 text-gray-800 line-clamp-2">{{ $product->name }}</h3>

                            @if ($product->short_description)
                                <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $product->short_description }}</p>
                            @endif

                            <!-- Price -->
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center space-x-2">
                                    <span class="text-lg font-bold text-green-600">{{ $product->formatted_price }}</span>
                                    @if ($product->compare_price)
                                        <span
                                            class="text-sm text-gray-500 line-through">{{ $product->formatted_compare_price }}</span>
                                    @endif
                                </div>

                                <!-- Stock Status -->
                                <span class="text-xs px-2 py-1 rounded-full {{ $product->stock_status_color }}">
                                    {{ $product->stock_status }}
                                </span>
                            </div>

                            <!-- Category -->
                            @if ($product->category)
                                <div class="mb-3">
                                    <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded-full">
                                        {{ $product->category->name }}
                                    </span>
                                </div>
                            @endif

                            <!-- Add to Cart Button -->
                            <a href="{{ route('checkout.product', $product) }}"
                                class="w-full bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-lg font-semibold transition duration-200 flex items-center justify-center space-x-2">
                                <span class="text-md text-gray-800">🛒</span>
                                <span>অর্ডার করুন</span>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- View All Products Button -->
            <div class="text-center mt-12">
                <a href="#"
                    class="inline-flex items-center bg-blue-500 hover:bg-blue-600 text-white px-8 py-3 rounded-full font-semibold transition duration-200 space-x-2">
                    <span>সব পণ্য দেখুন</span>
                    <span>→</span>
                </a>
            </div>
        </div>
    </section>
@endsection
