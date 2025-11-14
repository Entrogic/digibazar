{{-- resources/views/sections/youtube_iframe.blade.php --}}
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            {{-- YouTube Video (Left) --}}
            <div class="relative aspect-video rounded-2xl overflow-hidden shadow-2xl">
                @if(isset($data['youtube_id']))
                    <iframe 
                        src="https://www.youtube.com/embed/{{ $data['youtube_id'] }}" 
                        title="YouTube video player" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen
                        class="w-full h-full">
                    </iframe>
                @else
                    <div class="bg-gray-200 w-full h-full flex items-center justify-center">
                        <span class="text-gray-400">YouTube Video Placeholder</span>
                    </div>
                @endif
            </div>
            
            {{-- Text Content (Right) --}}
            <div class="space-y-6">
                <h2 class="text-4xl font-bold text-gray-900 leading-tight">
                    {{ $data['heading'] ?? 'Watch Our Video' }}
                </h2>
                <p class="text-lg text-gray-600 leading-relaxed">
                    {{ $data['description'] ?? 'Learn more about what we do by watching our video presentation.' }}
                </p>
            </div>
        </div>
    </div>
</section>