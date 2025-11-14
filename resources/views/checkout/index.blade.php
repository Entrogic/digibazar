@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="container mx-auto px-4">
            <!-- Breadcrumb -->
            <nav class="flex mb-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                </path>
                            </svg>
                            হোম
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 111.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">চেকআউট</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Empty Cart Message -->
            <div class="max-w-md mx-auto text-center py-16">
                <div class="mb-8">
                    <svg class="w-24 h-24 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6H19M7 13v6a2 2 0 002 2h6a2 2 0 002-2v-6M7 13H5a2 2 0 01-2-2V7a2 2 0 012-2h2m5 4v6m4-6v6">
                        </path>
                    </svg>
                </div>

                <h2 class="text-2xl font-bold text-gray-800 mb-4">আপনার কার্ট খালি</h2>
                <p class="text-gray-600 mb-8">
                    এখনো কোনো পণ্য যোগ করেননি। আমাদের দুর্দান্ত পণ্যগুলো দেখুন।
                </p>

                <a href="{{ route('home') }}"
                    class="inline-flex items-center bg-green-500 hover:bg-green-600 text-white px-8 py-3 rounded-full font-semibold transition duration-200 space-x-2">
                    <span>🛒</span>
                    <span>কেনাকাটা শুরু করুন</span>
                </a>
            </div>
        </div>
    </div>
@endsection
