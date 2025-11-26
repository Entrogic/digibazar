<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ \App\Models\Setting::get('site_name', 'Pahar Theke') }} -
        {{ \App\Models\Setting::get('site_tagline', 'Pahar Theke') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset(\App\Models\Setting::get('favicon', '/favicon.ico')) }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Hind Siliguri', sans-serif;
        }

        .hero-bg {
            background: linear-gradient(rgba(30, 30, 50, 0.7), rgba(30, 30, 50, 0.7)),
                url('https://images.unsplash.com/photo-1542838132-92c53300491e?w=1200') center/cover;
        }

        /* Line clamp utilities */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
    @stack('style')
    
    {{-- Tracking Scripts (Facebook Pixel, Google Analytics, etc.) --}}
    @include('partials.tracking-scripts')
</head>

<body class="bg-gray-50">

    @include('layouts.partials.header')

    <!-- Alert Messages -->
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mx-4 my-4"
            role="alert">
            <div class="container mx-auto flex items-center">
                <span class="text-lg mr-2">✅</span>
                <span class="block sm:inline">{{ session('success') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer"
                    onclick="this.parentElement.style.display='none'">
                    <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <path
                            d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                    </svg>
                </span>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mx-4 my-4" role="alert">
            <div class="container mx-auto flex items-center">
                <span class="text-lg mr-2">❌</span>
                <span class="block sm:inline">{{ session('error') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer"
                    onclick="this.parentElement.style.display='none'">
                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <path
                            d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                    </svg>
                </span>
            </div>
        </div>
    @endif

    @if (session('info'))
        <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative mx-4 my-4"
            role="alert">
            <div class="container mx-auto flex items-center">
                <span class="text-lg mr-2">ℹ️</span>
                <span class="block sm:inline">{{ session('info') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer"
                    onclick="this.parentElement.style.display='none'">
                    <svg class="fill-current h-6 w-6 text-blue-500" role="button" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <path
                            d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                    </svg>
                </span>
            </div>
        </div>
    @endif


    <!-- Main Content -->

    @php
        $url = \App\Models\Setting::get('whatsapp_url');
    @endphp

    @yield('content')

    <a href="{{$url}}" target="_blank"
        class="fixed bottom-5 right-5 z-50 w-14 h-14 rounded-full bg-green-500 shadow-lg flex items-center justify-center animate-bounce">
        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp" class="w-7 h-7" />
    </a>

    <!-- Footer -->
    @include('layouts.partials.footer')


    @stack('scripts')

</body>

</html>
