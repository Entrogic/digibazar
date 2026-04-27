@extends('layouts.app')

@section('content')
@php
    $item = $order->order_item->first();
    $product = $item?->product;
@endphp

<div class="min-h-screen bg-gray-50 py-8">
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto">

            <!-- Header -->
            <div class="text-center mb-6">
                <h1 class="text-2xl font-bold text-gray-900 mb-2">অর্ডার ট্র্যাকিং</h1>
                <p class="text-gray-600">
                    অর্ডার নম্বর:
                    <span class="font-mono font-bold">{{ $order->order_number }}</span>
                </p>
            </div>

            <!-- Order Status Timeline -->
            <div class="bg-white shadow-lg rounded-lg p-6 mb-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">অর্ডার অবস্থা</h2>

                @php
                    $statusOrder = ['pending', 'confirmed', 'processing', 'out_for_delivery', 'delivered'];
                    $currentIndex = array_search($order->status, $statusOrder);
                @endphp

                <div class="relative">
                    <div class="absolute left-4 top-0 bottom-0 w-0.5 bg-gray-200"></div>

                    <div class="space-y-6">

                        <!-- Order Received -->
                        <div class="relative flex items-center">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center bg-green-500 text-white">
                                ✓
                            </div>
                            <div class="ml-4">
                                <h3 class="text-sm font-medium text-gray-900">অর্ডার গ্রহণ</h3>
                                <p class="text-xs text-gray-500">{{ $order->created_at->format('F d, Y - h:i A') }}</p>
                            </div>
                        </div>

                        <!-- Confirmed -->
                        <div class="relative flex items-center">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center {{ $currentIndex >= 1 ? 'bg-green-500 text-white' : 'bg-gray-300' }}">
                                2
                            </div>
                            <div class="ml-4">
                                <h3 class="text-sm font-medium text-gray-900">নিশ্চিত</h3>
                            </div>
                        </div>

                        <!-- Processing -->
                        <div class="relative flex items-center">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center {{ $currentIndex >= 2 ? 'bg-green-500 text-white' : 'bg-gray-300' }}">
                                3
                            </div>
                            <div class="ml-4">
                                <h3 class="text-sm font-medium text-gray-900">প্রস্তুতি</h3>
                            </div>
                        </div>

                        <!-- Delivery -->
                        <div class="relative flex items-center">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center {{ $currentIndex >= 3 ? 'bg-green-500 text-white' : 'bg-gray-300' }}">
                                4
                            </div>
                            <div class="ml-4">
                                <h3 class="text-sm font-medium text-gray-900">ডেলিভারি</h3>
                            </div>
                        </div>

                        <!-- Delivered -->
                        <div class="relative flex items-center">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center {{ $order->status == 'delivered' ? 'bg-green-500 text-white' : 'bg-gray-300' }}">
                                5
                            </div>
                            <div class="ml-4">
                                <h3 class="text-sm font-medium text-gray-900">সম্পন্ন</h3>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Status Text -->
                <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                    <p class="text-sm text-blue-700">
                        {{ $order->status }}
                    </p>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="bg-white shadow-lg rounded-lg p-6 mb-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">অর্ডার সারাংশ</h2>

                <div class="flex items-start space-x-4 mb-4">

                    {{-- 🔥 FIXED IMAGE --}}
                    @if($product)
                        <img src="{{ $product->main_image }}" alt="{{ $product->name }}"
                             class="w-16 h-16 object-cover rounded-lg border">
                    @endif

                    <div class="flex-1">
                        {{-- PRODUCT NAME --}}
                        <h3 class="font-medium text-gray-900">
                            {{ $product->name ?? 'Product not found' }}
                        </h3>

                        {{-- CATEGORY --}}
                        @if($product && $product->category)
                            <p class="text-sm text-gray-600">{{ $product->category->name }}</p>
                        @endif

                        {{-- QUANTITY + PRICE --}}
                        <div class="mt-2 text-sm">
                            <span class="text-gray-600">পরিমাণ:</span>
                            <span class="font-medium">
                                {{ $item->quantity ?? 0 }} টি
                            </span>
                        </div>
                    </div>
                </div>

                {{-- CUSTOMER INFO --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-gray-600">গ্রাহক:</span>
                        <span class="font-medium ml-2">{{ $order->customer_name }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">ফোন:</span>
                        <span class="font-medium ml-2">{{ $order->customer_phone }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">পেমেন্ট:</span>
                        <span class="font-medium ml-2">{{ $order->payment_method }}</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection