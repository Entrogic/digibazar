@extends('layouts.app')
@push('style')
      <style>
        .slider-item {
            display: none;
        }
        .slider-item.active {
            display: block;
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }
        .animation-delay-200 {
            animation-delay: 0.2s;
            opacity: 0;
        }
        .animation-delay-400 {
            animation-delay: 0.4s;
            opacity: 0;
        }
    </style>
@endpush
@section('content')
    <div id="slider" class="relative w-full overflow-hidden bg-gray-900">
        <div class="relative h-[500px] md:h-[600px] lg:h-[700px]">

            <!-- Slide 1 -->
            @forelse($banners as $banner)
                <div class="slider-item active absolute inset-0" data-slide="{{$banner->id}}">
                    <div class="absolute inset-0">
                        <img src="{{asset($banner->image)}}" alt="Slide 1"
                            class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                    </div>
                    <div class="relative h-full flex items-center">
                        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                            <div class="max-w-3xl">
                                <h1
                                    class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold text-white mb-4 animate-fade-in-up">
                                    {{$banner->title}}
                                </h1>
                                <p
                                    class="text-lg sm:text-xl md:text-2xl text-gray-200 mb-8 animate-fade-in-up animation-delay-200">
                                           {{$banner->subtitle}}
                                </p>
                                <a href="{{$banner->button_link}}"
                                    class="inline-block px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-lg transition-all duration-300 transform hover:scale-105 animate-fade-in-up animation-delay-400">
                                    {{$banner->button_text}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
            @endforelse

        </div>

        <!-- Navigation Arrows -->
        <button id="prevBtn"
            class="absolute left-4 top-1/2 -translate-y-1/2 bg-white bg-opacity-30 hover:bg-opacity-50 text-white p-3 rounded-full transition-all duration-300 backdrop-blur-sm z-10">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>

        <button id="nextBtn"
            class="absolute right-4 top-1/2 -translate-y-1/2 bg-white bg-opacity-30 hover:bg-opacity-50 text-white p-3 rounded-full transition-all duration-300 backdrop-blur-sm z-10">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>

        <!-- Dots Navigation -->
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex space-x-3 z-10">
            @foreach ($banners as $banner)
            <button class="dot w-3 h-3 rounded-full bg-white transition-all  duration-300" data-slide="{{ $banner->id}}"></button>
            @endforeach
        </div>
    </div>

    @include('landing.index')


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
                                class="w-full h-68 object-cover">

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
                                class="w-full bg-green-900 hover:bg-green-600 text-white py-2 px-4 rounded-lg font-semibold transition duration-200 flex items-center justify-center space-x-2">
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
                    class="inline-flex items-center bg-green-900 hover:bg-blue-600 text-white px-8 py-3 rounded-full font-semibold transition duration-200 space-x-2">
                    <span>সব পণ্য দেখুন</span>
                    <span>→</span>
                </a>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            let currentSlide = 0;
            const slides = $('.slider-item');
            const dots = $('.dot');
            const totalSlides = slides.length;
            let autoplayInterval;

            // Show slide function
            function showSlide(index) {
                slides.removeClass('active').eq(index).addClass('active');
                dots.removeClass('bg-white').addClass('bg-white bg-opacity-50')
                    .eq(index).removeClass('bg-opacity-50').addClass('bg-white');
                currentSlide = index;
            }

            // Next slide
            function nextSlide() {
                let next = (currentSlide + 1) % totalSlides;
                showSlide(next);
            }

            // Previous slide
            function prevSlide() {
                let prev = (currentSlide - 1 + totalSlides) % totalSlides;
                showSlide(prev);
            }

            // Autoplay
            function startAutoplay() {
                autoplayInterval = setInterval(nextSlide, 5000);
            }

            function stopAutoplay() {
                clearInterval(autoplayInterval);
            }

            // Event listeners
            $('#nextBtn').click(function() {
                nextSlide();
                stopAutoplay();
                startAutoplay();
            });

            $('#prevBtn').click(function() {
                prevSlide();
                stopAutoplay();
                startAutoplay();
            });

            $('.dot').click(function() {
                let slideIndex = $(this).data('slide');
                showSlide(slideIndex);
                stopAutoplay();
                startAutoplay();
            });

            // Pause on hover
            $('#slider').hover(
                function() {
                    stopAutoplay();
                },
                function() {
                    startAutoplay();
                }
            );

            // Keyboard navigation
            $(document).keydown(function(e) {
                if (e.key === 'ArrowLeft') {
                    prevSlide();
                    stopAutoplay();
                    startAutoplay();
                } else if (e.key === 'ArrowRight') {
                    nextSlide();
                    stopAutoplay();
                    startAutoplay();
                }
            });

            // Touch/Swipe support
            let touchStartX = 0;
            let touchEndX = 0;

            $('#slider').on('touchstart', function(e) {
                touchStartX = e.changedTouches[0].screenX;
            });

            $('#slider').on('touchend', function(e) {
                touchEndX = e.changedTouches[0].screenX;
                handleSwipe();
            });

            function handleSwipe() {
                if (touchEndX < touchStartX - 50) {
                    nextSlide();
                    stopAutoplay();
                    startAutoplay();
                }
                if (touchEndX > touchStartX + 50) {
                    prevSlide();
                    stopAutoplay();
                    startAutoplay();
                }
            }

            // Start autoplay
            startAutoplay();
        });
    </script>
@endpush
