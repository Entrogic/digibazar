@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="container mx-auto px-4">
            <div class="max-w-md mx-auto">
                <!-- Header -->
                <div class="text-center mb-8">
                    <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-blue-100 mb-4">
                        <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <h1 class="text-2xl font-bold text-gray-900 mb-2">অর্ডার ট্র্যাক করুন</h1>
                    <p class="text-gray-600">আপনার অর্ডার নম্বর এবং ফোন নম্বর দিয়ে অর্ডারের অবস্থা জানুন</p>
                </div>

                <!-- Track Form -->
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <form method="POST" action="{{ route('track.order') }}" class="space-y-6">
                        @csrf

                        <div>
                            <label for="order_number" class="block text-sm font-medium text-gray-700 mb-2">
                                অর্ডার নম্বর *
                            </label>
                            <input type="text" id="order_number" name="order_number" value="{{ old('order_number') }}"
                                required placeholder="ORD20251028XXXX"
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 font-mono">
                            @error('order_number')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                ফোন নম্বর *
                            </label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required
                                placeholder="০১৭xxxxxxxx"
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 px-6 rounded-lg font-medium transition duration-200 flex items-center justify-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <span>অর্ডার ট্র্যাক করুন</span>
                        </button>
                    </form>
                </div>

                <!-- Instructions -->
                <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <h3 class="text-blue-800 font-medium mb-2">কিভাবে ট্র্যাক করবেন?</h3>
                    <ul class="text-sm text-blue-700 space-y-1">
                        <li>• অর্ডার নম্বর সম্পূর্ণভাবে লিখুন (যেমন: ORD20251028XXXX)</li>
                        <li>• অর্ডারের সময় যে ফোন নম্বর দিয়েছিলেন সেটি লিখুন</li>
                        <li>• উভয় তথ্য সঠিক হলে আপনার অর্ডারের বর্তমান অবস্থা দেখতে পাবেন</li>
                    </ul>
                </div>

                <!-- Back to Home -->
                <div class="mt-6 text-center">
                    <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-500 font-medium">
                        ← হোম পেজে ফিরুন
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
