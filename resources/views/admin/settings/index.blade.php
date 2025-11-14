@extends('layouts.admin')

@section('content')
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Page Header -->
            <div class="md:flex md:items-center md:justify-between mb-6">
                <div class="flex-1 min-w-0">
                    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                        Settings
                    </h2>
                    <p class="mt-1 text-sm text-gray-500">
                        Manage your website settings, appearance, and configuration
                    </p>
                </div>
                <div class="mt-4 flex md:mt-0 md:ml-4">
                    <form action="{{ route('admin.settings.reset') }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to reset all settings to default values?')">
                        @csrf
                        <button type="submit"
                            class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                            Reset to Default
                        </button>
                    </form>
                </div>
            </div>

            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    @foreach ($settings as $groupName => $groupSettings)
                        <!-- Settings Group -->
                        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                                <h3 class="text-lg font-medium text-gray-900 capitalize">
                                    {{ str_replace('_', ' ', $groupName) }}
                                </h3>
                            </div>

                            <div class="px-6 py-4">
                                <div class="grid grid-cols-1 gap-6">
                                    @foreach ($groupSettings as $setting)
                                        <div>
                                            <label for="{{ $setting->setting_key }}"
                                                class="block text-sm font-medium text-gray-700 mb-2">
                                                {{ $setting->label }}
                                                @if ($setting->description)
                                                    <span
                                                        class="text-xs text-gray-500 block">{{ $setting->description }}</span>
                                                @endif
                                            </label>

                                            @if ($setting->type === 'text' || $setting->type === 'email' || $setting->type === 'url' || $setting->type === 'number')
                                                <input type="{{ $setting->type }}" id="{{ $setting->setting_key }}"
                                                    name="{{ $setting->setting_key }}" value="{{ $setting->value }}"
                                                    class="w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                            @elseif($setting->type === 'textarea')
                                                <textarea id="{{ $setting->setting_key }}" name="{{ $setting->setting_key }}" rows="3"
                                                    class="w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ $setting->value }}</textarea>
                                            @elseif($setting->type === 'image')
                                                <div class="space-y-2">
                                                    @if ($setting->value)
                                                        <div class="mb-2">
                                                            <img src="{{ asset($setting->value) }}"
                                                                alt="{{ $setting->label }}"
                                                                class="h-20 w-auto object-contain border border-gray-300 rounded">
                                                        </div>
                                                    @endif
                                                    <input type="file" id="{{ $setting->setting_key }}"
                                                        name="{{ $setting->setting_key }}" accept="image/*"
                                                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                                    <input type="hidden" name="current_{{ $setting->setting_key }}"
                                                        value="{{ $setting->value }}">
                                                </div>
                                            @elseif($setting->type === 'boolean')
                                                <label class="inline-flex items-center">
                                                    <input type="checkbox" id="{{ $setting->setting_key }}"
                                                        name="{{ $setting->setting_key }}" value="1"
                                                        {{ $setting->value ? 'checked' : '' }}
                                                        class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                                    <span class="ml-2 text-sm text-gray-600">Enable</span>
                                                </label>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Save Button -->
                <div class="mt-6 flex justify-end">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md font-medium transition duration-200">
                        Save Settings
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
