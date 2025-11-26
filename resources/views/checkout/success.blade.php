@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="container mx-auto px-4">
            <!-- Success Icon and Message -->
            <div class="max-w-3xl mx-auto">
                <!-- Success Header -->
                <div class="text-center mb-8">
                    <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-green-100 mb-6">
                        <svg class="h-12 w-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">অর্ডার সফল হয়েছে!</h1>
                    <p class="text-lg text-gray-600">আপনার অর্ডারটি সফলভাবে গ্রহণ করা হয়েছে। আমরা শীঘ্রই আপনার সাথে যোগাযোগ
                        করব।</p>
                </div>

                <!-- Order Details Card -->
                <div class="bg-white shadow-lg rounded-lg overflow-hidden mb-6">
                    <div class="bg-green-50 px-6 py-4 border-b border-green-200">
                        <h2 class="text-xl font-semibold text-green-800">অর্ডার বিবরণ</h2>
                    </div>

                    <div class="p-6">
                        <!-- Order Number -->
                        <div class="mb-6 text-center">
                            <h3 class="text-lg font-medium text-gray-700 mb-2">অর্ডার নম্বর</h3>
                            <div class="inline-flex items-center bg-gray-100 px-4 py-2 rounded-lg">
                                <span class="text-2xl font-bold text-gray-900 font-mono">{{ $order->order_number }}</span>
                            </div>
                        </div>

                        <!-- Product Information -->
                        <div class="border rounded-lg p-4 mb-6">
                            <h4 class="text-lg font-semibold text-gray-800 mb-4">পণ্যের তথ্য</h4>
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0">
                                    <img src="{{ $order->order_item->product->main_image }}" alt="{{ $order->order_item->product_name }}"
                                        class="w-20 h-20 object-cover rounded-lg border">
                                </div>
                                <div class="flex-1">
                                    <h5 class="text-lg font-medium text-gray-900 mb-1">{{ $order->order_item->product_name }}</h5>
                                    {{-- @if ($order->product->category)
                                        <p class="text-sm text-gray-600 mb-2">বিভাগ: {{ $order->product->category->name }}
                                        </p>
                                    @endif --}}
                                    <div class="grid grid-cols-2 gap-4 text-sm">
                                        <div>
                                            <span class="text-gray-600">একক দাম:</span>
                                            <span class="font-medium ml-2">{{ $order->order_item->price }}</span>
                                        </div>
                                        <div>
                                            <span class="text-gray-600">পরিমাণ:</span>
                                            <span class="font-medium ml-2">{{  $order->order_item->quantity }} {{ $order->order_item->product->unit->name ?? 'টি' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Order Summary -->
                        <div class="bg-gray-50 rounded-lg p-4 mb-6">
                            <h4 class="text-lg font-semibold text-gray-800 mb-4">অর্ডার সারাংশ</h4>
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">পণ্যের দাম ({{ $order->order_item->quantity }} {{ $order->order_item->product->unit->name ?? 'টি' }}):</span>
                                    <span class="font-medium">{{ $order->order_item->total }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">ডেলিভারি চার্জ:</span>
                                    <span class="font-medium text-green-600">{{ $order->delivery_charge }}</span>
                                </div>
                                <div class="border-t pt-2">
                                    <div class="flex justify-between text-lg font-bold">
                                        <span>মোট পরিশোধযোগ্য:</span>
                                        <span class="text-green-600">{{ $order->order_total }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Customer Information -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <h4 class="text-lg font-semibold text-gray-800 mb-3">গ্রাহকের তথ্য</h4>
                                <div class="space-y-2 text-sm">
                                    <div>
                                        <span class="text-gray-600">নাম:</span>
                                        <span class="font-medium ml-2">{{ $order->customer_name }}</span>
                                    </div>
                                    <div>
                                        <span class="text-gray-600">ফোন:</span>
                                        <span class="font-medium ml-2">{{ $order->customer_phone }}</span>
                                    </div>
                                    @if ($order->customer_email)
                                        <div>
                                            <span class="text-gray-600">ইমেইল:</span>
                                            <span class="font-medium ml-2">{{ $order->customer_email }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div>
                                <h4 class="text-lg font-semibold text-gray-800 mb-3">ডেলিভারি তথ্য</h4>
                                <div class="space-y-2 text-sm">
                                    <div>
                                        <span class="text-gray-600">ঠিকানা:</span>
                                        <p class="font-medium mt-1 whitespace-pre-line">{{ $order->customer_address }}</p>
                                    </div>
                                    <div>
                                        <span class="text-gray-600">পেমেন্ট পদ্ধতি:</span>
                                        <span class="font-medium ml-2">{{ $order->payment_method_label }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Order Status -->
                        <div class="bg-blue-50 rounded-lg p-4 mb-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h4 class="text-lg font-medium text-blue-800">বর্তমান অবস্থা</h4>
                                    <p class="text-blue-700">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $order->status_color }}">
                                            {{ $order->status_label }}
                                        </span>
                                        <span class="ml-2">- আপনার অর্ডারটি প্রক্রিয়াধীন রয়েছে</span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Order Date -->
                        <div class="text-center text-sm text-gray-600">
                            <p>অর্ডারের তারিখ: {{ $order->created_at->format('F d, Y - h:i A') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Important Information -->
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h4 class="text-yellow-800 font-medium">গুরুত্বপূর্ণ তথ্য</h4>
                            <div class="mt-2 text-sm text-yellow-700">
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>আমরা ১-২ ঘন্টার মধ্যে আপনার সাথে যোগাযোগ করে অর্ডার নিশ্চিত করব</li>
                                    <li>ডেলিভারি সময় সাধারণত ১-৩ কার্যদিবস</li>
                                    <li>যেকোনো সমস্যার জন্য আমাদের সাথে যোগাযোগ করুন</li>
                                    <li>আপনার অর্ডার নম্বরটি সংরক্ষণ করে রাখুন</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('home') }}"
                        class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-lg font-medium text-center transition duration-200 flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                        <span>হোম পেজে ফিরুন</span>
                    </a>

                    <a href="{{ route('track.form') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-medium text-center transition duration-200 flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <span>অর্ডার ট্র্যাক করুন</span>
                    </a>

                    <button onclick="window.print()"
                        class="bg-gray-600 hover:bg-gray-700 text-white px-8 py-3 rounded-lg font-medium text-center transition duration-200 flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z">
                            </path>
                        </svg>
                        <span>প্রিন্ট করুন</span>
                    </button>
                </div>

                <!-- Contact Information -->
                <div class="mt-8 text-center text-sm text-gray-600">
                    <p>সহায়তার জন্য যোগাযোগ করুন:</p>
                    <p class="font-medium">ফোন: ০১৭১২৩৪৫৬৭৮ | ইমেইল: support@dizibazar.com</p>
                </div>
            </div>
        </div>
    </div>

    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            .container,
            .container * {
                visibility: visible;
            }

            .max-w-3xl {
                max-width: none !important;
            }

            button {
                display: none !important;
            }


            .bg-gray-50 {
                background-color: white !important;
            }
        }
    </style>

    {{-- Facebook Pixel Purchase Event --}}
    @include('partials.fb-pixel-event', [
        'event' => 'Purchase',
        'data' => [
            'value' => $order->order_total,
            'currency' => 'BDT',
            'content_type' => 'product',
            'content_ids' => [$order->order_item->product_id],
            'num_items' => $order->order_item->quantity
        ]
    ])
@endsection
