@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="container mx-auto px-4">
            <div class="max-w-2xl mx-auto">
                <!-- Header -->
                <div class="text-center mb-6">
                    <h1 class="text-2xl font-bold text-gray-900 mb-2">অর্ডার ট্র্যাকিং</h1>
                    <p class="text-gray-600">অর্ডার নম্বর: <span class="font-mono font-bold">{{ $order->order_number }}</span>
                    </p>
                </div>

                <!-- Order Status Timeline -->
                <div class="bg-white shadow-lg rounded-lg p-6 mb-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">অর্ডার অবস্থা</h2>

                    <div class="relative">
                        <!-- Timeline -->
                        <div class="absolute left-4 top-0 bottom-0 w-0.5 bg-gray-200"></div>

                        <!-- Status Steps -->
                        <div class="space-y-6">
                            <!-- Pending -->
                            <div class="relative flex items-center">
                                <div class="flex-shrink-0">
                                    <div
                                        class="w-8 h-8 rounded-full flex items-center justify-center {{ $order->status === 'pending' ? 'bg-yellow-500 text-white' : ($order->status !== 'cancelled' ? 'bg-green-500 text-white' : 'bg-gray-300 text-gray-600') }}">
                                        @if ($order->status === 'pending')
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        @elseif($order->status !== 'cancelled')
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        @else
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        @endif
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-sm font-medium text-gray-900">অর্ডার গ্রহণ</h3>
                                    <p class="text-xs text-gray-500">{{ $order->created_at->format('F d, Y - h:i A') }}</p>
                                </div>
                            </div>

                            <!-- Confirmed -->
                            @php
                                $statusOrder = ['pending', 'confirmed', 'processing', 'out_for_delivery', 'delivered'];
                                $currentIndex = array_search($order->status, $statusOrder);
                                $isConfirmed = $currentIndex >= 1;
                            @endphp
                            <div class="relative flex items-center">
                                <div class="flex-shrink-0">
                                    <div
                                        class="w-8 h-8 rounded-full flex items-center justify-center {{ $order->status === 'confirmed' ? 'bg-blue-500 text-white' : ($isConfirmed && $order->status !== 'cancelled' ? 'bg-green-500 text-white' : 'bg-gray-300 text-gray-600') }}">
                                        @if ($isConfirmed && $order->status !== 'cancelled')
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        @else
                                            <span class="text-xs font-bold">2</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-sm font-medium text-gray-900">অর্ডার নিশ্চিত</h3>
                                    <p class="text-xs text-gray-500">{{ $isConfirmed ? 'সম্পন্ন' : 'অপেক্ষমাণ' }}</p>
                                </div>
                            </div>

                            <!-- Processing -->
                            @php $isProcessing = $currentIndex >= 2; @endphp
                            <div class="relative flex items-center">
                                <div class="flex-shrink-0">
                                    <div
                                        class="w-8 h-8 rounded-full flex items-center justify-center {{ $order->status === 'processing' ? 'bg-purple-500 text-white' : ($isProcessing && $order->status !== 'cancelled' ? 'bg-green-500 text-white' : 'bg-gray-300 text-gray-600') }}">
                                        @if ($isProcessing && $order->status !== 'cancelled')
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        @else
                                            <span class="text-xs font-bold">3</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-sm font-medium text-gray-900">প্রস্তুতিরত</h3>
                                    <p class="text-xs text-gray-500">{{ $isProcessing ? 'সম্পন্ন' : 'অপেক্ষমাণ' }}</p>
                                </div>
                            </div>

                            <!-- Out for Delivery -->
                            @php $isOutForDelivery = $currentIndex >= 3; @endphp
                            <div class="relative flex items-center">
                                <div class="flex-shrink-0">
                                    <div
                                        class="w-8 h-8 rounded-full flex items-center justify-center {{ $order->status === 'out_for_delivery' ? 'bg-orange-500 text-white' : ($isOutForDelivery && $order->status !== 'cancelled' ? 'bg-green-500 text-white' : 'bg-gray-300 text-gray-600') }}">
                                        @if ($isOutForDelivery && $order->status !== 'cancelled')
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        @else
                                            <span class="text-xs font-bold">4</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-sm font-medium text-gray-900">ডেলিভারিতে</h3>
                                    <p class="text-xs text-gray-500">{{ $isOutForDelivery ? 'সম্পন্ন' : 'অপেক্ষমাণ' }}</p>
                                </div>
                            </div>

                            <!-- Delivered -->
                            @php $isDelivered = $order->status === 'delivered'; @endphp
                            <div class="relative flex items-center">
                                <div class="flex-shrink-0">
                                    <div
                                        class="w-8 h-8 rounded-full flex items-center justify-center {{ $isDelivered ? 'bg-green-500 text-white' : 'bg-gray-300 text-gray-600' }}">
                                        @if ($isDelivered)
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        @else
                                            <span class="text-xs font-bold">5</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-sm font-medium text-gray-900">ডেলিভার সম্পন্ন</h3>
                                    <p class="text-xs text-gray-500">
                                        @if ($isDelivered && $order->delivered_at)
                                            {{ $order->delivered_at->format('F d, Y - h:i A') }}
                                        @else
                                            অপেক্ষমাণ
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Current Status -->
                    <div
                        class="mt-6 p-4 rounded-lg {{ $order->status === 'cancelled' ? 'bg-red-50 border border-red-200' : 'bg-blue-50 border border-blue-200' }}">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $order->status_color }}">
                                    {{ $order->status_label }}
                                </span>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm {{ $order->status === 'cancelled' ? 'text-red-700' : 'text-blue-700' }}">
                                    @if ($order->status === 'pending')
                                        আপনার অর্ডারটি গ্রহণ করা হয়েছে এবং প্রক্রিয়াধীন রয়েছে।
                                    @elseif($order->status === 'confirmed')
                                        আপনার অর্ডারটি নিশ্চিত করা হয়েছে।
                                    @elseif($order->status === 'processing')
                                        আপনার অর্ডারটি প্রস্তুত করা হচ্ছে।
                                    @elseif($order->status === 'out_for_delivery')
                                        আপনার অর্ডারটি ডেলিভারির জন্য পাঠানো হয়েছে।
                                    @elseif($order->status === 'delivered')
                                        আপনার অর্ডারটি সফলভাবে ডেলিভার হয়েছে।
                                    @elseif($order->status === 'cancelled')
                                        আপনার অর্ডারটি বাতিল করা হয়েছে।
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Details Summary -->
                <div class="bg-white shadow-lg rounded-lg p-6 mb-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">অর্ডার সারাংশ</h2>

                    <div class="flex items-start space-x-4 mb-4">
                        <img src="{{ $order->product->main_image }}" alt="{{ $order->product->name }}"
                            class="w-16 h-16 object-cover rounded-lg border">
                        <div class="flex-1">
                            <h3 class="font-medium text-gray-900">{{ $order->product->name }}</h3>
                            @if ($order->product->category)
                                <p class="text-sm text-gray-600">{{ $order->product->category->name }}</p>
                            @endif
                            <div class="mt-2 text-sm">
                                <span class="text-gray-600">পরিমাণ:</span>
                                <span class="font-medium">{{ $order->quantity }} টি</span>
                                <span class="mx-2">•</span>
                                <span class="text-gray-600">মোট:</span>
                                <span class="font-medium text-green-600">{{ $order->formatted_total_price }}</span>
                            </div>
                        </div>
                    </div>

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
                            <span class="font-medium ml-2">{{ $order->payment_method_label }}</span>
                        </div>
                        <div>
                            <span class="text-gray-600">অর্ডার তারিখ:</span>
                            <span class="font-medium ml-2">{{ $order->created_at->format('M d, Y') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('track.form') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium text-center transition duration-200">
                        অন্য অর্ডার ট্র্যাক করুন
                    </a>

                    <a href="{{ route('home') }}"
                        class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg font-medium text-center transition duration-200">
                        হোম পেজে ফিরুন
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
