{{-- resources/views/sections/text_image.blade.php --}}
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            {{-- Text Content (Left) --}}
            <div class="space-y-6">
                <h2 class="text-4xl font-bold text-gray-900 leading-tight">
                    {{ $data['heading'] ?? 'Default Heading' }}
                </h2>
                <p class="text-lg text-gray-600 leading-relaxed">
                    {{ $data['description'] ?? 'Default description text goes here.' }}
                </p>
            </div>
            
            {{-- Image (Right) --}}
            <div class="relative">
                @if(isset($data['image']))
                    <img src="{{ asset('storage/' . $data['image']) }}" 
                         alt="{{ $data['heading'] ?? 'Section Image' }}"
                         class="rounded-2xl shadow-2xl w-full h-auto object-cover">
                @else
                    <div class="bg-gray-200 rounded-2xl h-96 flex items-center justify-center">
                        <span class="text-gray-400">Image placeholder</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>