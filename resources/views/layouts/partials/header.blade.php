<header class="bg-white shadow-sm">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}" class="flex items-center">
                    <img src="{{ asset(\App\Models\Setting::get('logo', '/logo1.png')) }}"
                        alt="{{ \App\Models\Setting::get('site_name', 'DiziBazar') }}" class="h-12 w-auto">
                    {{-- <span class="ml-2 text-xl font-bold text-gray-900">{{ \App\Models\Setting::get('site_name', 'DiziBazar') }}</span> --}}
                </a>
            </div>

            <!-- Navigation Menu -->
            <nav class="hidden md:flex space-x-8">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium">
                    Home
                </a>
                <a href="{{ route('track.form') }}"
                    class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium">
                    Track Order
                </a>
            </nav>

            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button type="button" class="text-gray-700 hover:text-blue-600 focus:outline-none focus:text-blue-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</header>
