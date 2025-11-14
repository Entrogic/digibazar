@extends('layouts.admin')

@section('title', 'ক্যাটেগরি বিস্তারিত')

@section('content')
    <div class="p-6">
        <!-- Page header -->
        <div class="mb-8">
            <div class="sm:flex sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900">ক্যাটেগরি বিস্তারিত</h1>
                    <p class="mt-1 text-sm text-gray-600">{{ $category->name }} ক্যাটেগরির সম্পূর্ণ তথ্য</p>
                </div>
                <div class="mt-4 sm:mt-0 flex space-x-3">
                    <a href="{{ route('admin.categories.edit', $category) }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                        সম্পাদনা
                    </a>
                    <a href="{{ route('admin.categories.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        ফিরে যান
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Information -->
            <div class="lg:col-span-2">
                <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">ক্যাটেগরি তথ্য</h3>
                    </div>
                    <div class="p-6 space-y-6">
                        <!-- Category Header -->
                        <div class="flex items-center space-x-4">
                            @if ($category->image)
                                <img src="{{ $category->image_url }}" alt="{{ $category->name }}"
                                    class="h-16 w-16 object-cover rounded-lg">
                            @else
                                <div class="h-16 w-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                    @if ($category->icon)
                                        <span class="text-2xl">{{ $category->icon }}</span>
                                    @else
                                        <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                            </path>
                                        </svg>
                                    @endif
                                </div>
                            @endif
                            <div>
                                <h2 class="text-xl font-semibold text-gray-900">{{ $category->name }}</h2>
                                @if ($category->name_en)
                                    <p class="text-sm text-gray-600">{{ $category->name_en }}</p>
                                @endif
                                <p class="text-xs text-gray-400">{{ $category->slug }}</p>
                            </div>
                        </div>

                        <!-- Basic Info -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">স্ট্যাটাস</dt>
                                <dd class="mt-1">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $category->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $category->is_active ? 'সক্রিয়' : 'নিষ্ক্রিয়' }}
                                    </span>
                                </dd>
                            </div>

                            <div>
                                <dt class="text-sm font-medium text-gray-500">সর্ট অর্ডার</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $category->sort_order }}</dd>
                            </div>

                            @if ($category->parent)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">প্যারেন্ট ক্যাটেগরি</dt>
                                    <dd class="mt-1">
                                        <a href="{{ route('admin.categories.show', $category->parent) }}"
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 hover:bg-blue-200">
                                            {{ $category->parent->name }}
                                        </a>
                                    </dd>
                                </div>
                            @endif

                            <div>
                                <dt class="text-sm font-medium text-gray-500">সাব-ক্যাটেগরি</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $category->children->count() }} টি</dd>
                            </div>

                            <div>
                                <dt class="text-sm font-medium text-gray-500">তৈরি হয়েছে</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $category->created_at->format('d M, Y') }}</dd>
                            </div>

                            <div>
                                <dt class="text-sm font-medium text-gray-500">সর্বশেষ আপডেট</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $category->updated_at->format('d M, Y') }}</dd>
                            </div>
                        </div>

                        <!-- Description -->
                        @if ($category->description)
                            <div>
                                <dt class="text-sm font-medium text-gray-500 mb-2">বিবরণ</dt>
                                <dd class="text-sm text-gray-900 bg-gray-50 p-4 rounded-lg">
                                    {{ $category->description }}
                                </dd>
                            </div>
                        @endif

                        <!-- Full Path -->
                        <div>
                            <dt class="text-sm font-medium text-gray-500 mb-2">ক্যাটেগরি পাথ</dt>
                            <dd class="text-sm text-gray-900 bg-gray-50 p-4 rounded-lg font-mono">
                                {{ $category->full_path }}
                            </dd>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Quick Actions -->
                <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">দ্রুত কার্যক্রম</h3>
                    </div>
                    <div class="p-6 space-y-3">
                        <form action="{{ route('admin.categories.toggle-status', $category) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="w-full inline-flex justify-center items-center px-4 py-2 {{ $category->is_active ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700' }} border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ $category->is_active ? 'নিষ্ক্রিয় করুন' : 'সক্রিয় করুন' }}
                            </button>
                        </form>

                        <a href="{{ route('admin.categories.create') }}?parent_id={{ $category->id }}"
                            class="w-full inline-flex justify-center items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            সাব-ক্যাটেগরি যোগ করুন
                        </a>

                        @if (!$category->hasChildren())
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                                onsubmit="return confirm('আপনি কি নিশ্চিত যে এই ক্যাটেগরি মুছে ফেলতে চান?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-full inline-flex justify-center items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    ক্যাটেগরি মুছুন
                                </button>
                            </form>
                        @endif
                    </div>
                </div>

                <!-- Child Categories -->
                @if ($category->children->count() > 0)
                    <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">সাব-ক্যাটেগরি
                                ({{ $category->children->count() }})</h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-3">
                                @foreach ($category->children as $child)
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                        <div class="flex items-center space-x-3">
                                            @if ($child->icon)
                                                <span class="text-lg">{{ $child->icon }}</span>
                                            @endif
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">{{ $child->name }}</div>
                                                @if ($child->children_count > 0)
                                                    <div class="text-xs text-gray-500">{{ $child->children_count }}
                                                        সাব-ক্যাটেগরি</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <span
                                                class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $child->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $child->is_active ? 'সক্রিয়' : 'নিষ্ক্রিয়' }}
                                            </span>
                                            <a href="{{ route('admin.categories.show', $child) }}"
                                                class="text-blue-600 hover:text-blue-900">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                    </path>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
