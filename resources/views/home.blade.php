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
        from {opacity: 0; transform: translateY(30px);}
        to {opacity: 1; transform: translateY(0);}
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
<!-- Banner/Slider Section - Mobile Optimized -->
<div id="slider" class="relative w-full overflow-hidden bg-gray-900">
    <div class="relative h-[45vh] sm:h-[55vh] md:h-[65vh] lg:h-[75vh]">

        @forelse($banners as $banner)
        <div class="slider-item @if($loop->first) active @endif absolute inset-0" data-slide="{{$loop->index}}">
            <div class="absolute inset-0">
                <img src="{{asset($banner->image)}}" alt="Slide {{$loop->iteration}}" class="w-full h-full object-cover object-center">
                <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-black/50 to-black/60"></div>
            </div>
            <div class="relative h-full flex items-center">
                <div class="container mx-auto px-3 sm:px-4 md:px-6 lg:px-8">
                    <div class="max-w-full sm:max-w-2xl md:max-w-3xl">
                        <h1 class="text-xl xs:text-2xl sm:text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-bold text-white mb-2 sm:mb-3 md:mb-4 animate-fade-in-up leading-tight">{{$banner->title}}</h1>
                        <p class="text-xs xs:text-sm sm:text-base md:text-lg lg:text-xl text-gray-100 mb-3 sm:mb-4 md:mb-6 animate-fade-in-up animation-delay-200 leading-relaxed max-w-lg">{{$banner->subtitle}}</p>
                        <a href="{{$banner->button_link}}" class="inline-block px-4 py-2 xs:px-5 xs:py-2.5 sm:px-6 sm:py-3 md:px-8 md:py-4 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white text-xs xs:text-sm sm:text-base font-semibold rounded-md sm:rounded-lg shadow-lg transition-all duration-300 transform hover:scale-105 active:scale-95 animate-fade-in-up animation-delay-400">
                            {{$banner->button_text}}
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        @endforelse

    </div>

    <!-- Navigation Arrows - Mobile Optimized -->
    <button id="prevBtn" class="absolute left-1 xs:left-2 sm:left-3 md:left-4 top-1/2 -translate-y-1/2 bg-white/20 hover:bg-white/40 active:bg-white/50 backdrop-blur-sm text-white p-1.5 xs:p-2 sm:p-2.5 md:p-3 rounded-full transition-all duration-300 z-10 shadow-lg">
        <svg class="w-4 h-4 xs:w-5 xs:h-5 sm:w-5 sm:h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
        </svg>
    </button>
    <button id="nextBtn" class="absolute right-1 xs:right-2 sm:right-3 md:right-4 top-1/2 -translate-y-1/2 bg-white/20 hover:bg-white/40 active:bg-white/50 backdrop-blur-sm text-white p-1.5 xs:p-2 sm:p-2.5 md:p-3 rounded-full transition-all duration-300 z-10 shadow-lg">
        <svg class="w-4 h-4 xs:w-5 xs:h-5 sm:w-5 sm:h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
        </svg>
    </button>

    <!-- Dots Navigation - Mobile Optimized -->
    <div class="absolute bottom-2 xs:bottom-3 sm:bottom-4 md:bottom-6 lg:bottom-8 left-1/2 -translate-x-1/2 flex space-x-1.5 xs:space-x-2 sm:space-x-2.5 md:space-x-3 z-10">
        @foreach ($banners as $banner)
        <button class="dot w-2 h-2 xs:w-2.5 xs:h-2.5 sm:w-3 sm:h-3 rounded-full bg-white/40 hover:bg-white/60 transition-all duration-300 @if($loop->first) !bg-white scale-110 @endif shadow-md" data-slide="{{ $loop->index }}"></button>
        @endforeach
    </div>
</div>

@include('landing.index')

<!-- Featured Products Section -->
<section class="py-12 md:py-16 bg-white">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl sm:text-3xl font-bold text-center mb-3 sm:mb-4">বিশেষ অফার পণ্য</h2>
        <p class="text-center text-gray-600 mb-8 sm:mb-12">আমাদের সেরা ও জনপ্রিয় পণ্যসমূহ দেখুন</p>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
            @foreach ($featuredProducts as $product)
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition duration-300 overflow-hidden border">
                <div class="relative">
                    <img src="{{ $product->main_image }}" alt="{{ $product->name }}" class="w-full h-64 sm:h-72 md:h-80 lg:h-68 object-cover">
                    @if ($product->is_featured)
                    <span class="absolute top-2 left-2 bg-yellow-500 text-white text-xs px-2 py-1 rounded-full font-semibold">বিশেষ</span>
                    @endif
                    @if ($product->discount_percentage > 0)
                    <span class="absolute top-2 right-2 bg-red-500 text-white text-xs px-2 py-1 rounded-full font-semibold">{{ $product->discount_percentage }}% ছাড়</span>
                    @endif
                </div>
                <div class="p-3 sm:p-4">
                    <h3 class="font-semibold text-lg mb-1 sm:mb-2 text-gray-800 line-clamp-2">{{ $product->name }}</h3>
                    @if ($product->short_description)
                    <p class="text-gray-600 text-sm mb-2 sm:mb-3 line-clamp-2">{{ $product->short_description }}</p>
                    @endif
                    <div class="flex items-center justify-between mb-2 sm:mb-3">
                        <div class="flex items-center space-x-2">
                            <span class="text-green-600 font-bold text-base sm:text-lg">{{ $product->formatted_price }}</span>
                            @if ($product->compare_price)
                            <span class="text-gray-500 text-sm line-through">{{ $product->formatted_compare_price }}</span>
                            @endif
                        </div>
                        <span class="text-xs px-2 py-1 rounded-full {{ $product->stock_status_color }}">{{ $product->stock_status }}</span>
                    </div>
                    @if ($product->category)
                    <div class="mb-2 sm:mb-3">
                        <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded-full">{{ $product->category->name }}</span>
                    </div>
                    @endif
                    <a href="{{ route('checkout.product', $product) }}" class="w-full bg-green-900 hover:bg-green-600 text-white py-2 sm:py-2.5 px-3 sm:px-4 rounded-lg font-semibold flex items-center justify-center space-x-2 transition duration-200">
                        <span class="text-md sm:text-lg text-gray-800">🛒</span>
                        <span>অর্ডার করুন</span>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-8 sm:mt-12">
            <a href="#" class="inline-flex items-center bg-green-900 hover:bg-blue-600 text-white px-6 sm:px-8 py-2 sm:py-3 rounded-full font-semibold transition duration-200 space-x-2">
                <span>সব পণ্য দেখুন</span>
                <span>→</span>
            </a>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
$(document).ready(function(){
    let currentSlide = 0;
    const slides = $('.slider-item');
    const dots = $('.dot');
    const totalSlides = slides.length;
    let autoplayInterval;

    function showSlide(index){
        slides.removeClass('active').eq(index).addClass('active');
        dots.removeClass('!bg-white scale-110').eq(index).addClass('!bg-white scale-110');
        currentSlide = index;
    }

    function nextSlide(){ showSlide((currentSlide+1)%totalSlides); }
    function prevSlide(){ showSlide((currentSlide-1+totalSlides)%totalSlides); }

    function startAutoplay(){ autoplayInterval = setInterval(nextSlide,5000); }
    function stopAutoplay(){ clearInterval(autoplayInterval); }

    $('#nextBtn').click(function(){ nextSlide(); stopAutoplay(); startAutoplay(); });
    $('#prevBtn').click(function(){ prevSlide(); stopAutoplay(); startAutoplay(); });
    $('.dot').click(function(){ showSlide($(this).data('slide')); stopAutoplay(); startAutoplay(); });

    $('#slider').hover(stopAutoplay, startAutoplay);

    let touchStartX=0, touchEndX=0;
    $('#slider').on('touchstart', e=>{ touchStartX=e.changedTouches[0].screenX; });
    $('#slider').on('touchend', e=>{ touchEndX=e.changedTouches[0].screenX; if(touchEndX<touchStartX-50){ nextSlide(); stopAutoplay(); startAutoplay(); } if(touchEndX>touchStartX+50){ prevSlide(); stopAutoplay(); startAutoplay(); } });

    startAutoplay();
});
</script>
@endpush