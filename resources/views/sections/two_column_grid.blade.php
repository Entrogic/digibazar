{{-- resources/views/sections/two_column_grid.blade.php --}}
<section class="py-16 bg-gradient-to-br from-blue-50 to-indigo-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            {{-- Left Column --}}
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow duration-300">
                @if(isset($data['left_icon']))
                    <div class="mb-6">
                        <img src="{{ asset('storage/' . $data['left_icon']) }}" 
                             alt="Icon"
                             class="w-16 h-16 object-contain">
                    </div>
                @endif
                
                <h3 class="text-2xl font-bold text-gray-900 mb-4">
                    {{ $data['left_heading'] ?? 'Left Column Heading' }}
                </h3>
                
                <p class="text-gray-600 leading-relaxed">
                    {{ $data['left_description'] ?? 'Description for the left column goes here.' }}
                </p>
            </div>
            
            {{-- Right Column --}}
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow duration-300">
                @if(isset($data['right_icon']))
                    <div class="mb-6">
                        <img src="{{ asset('storage/' . $data['right_icon']) }}" 
                             alt="Icon"
                             class="w-16 h-16 object-contain">
                    </div>
                @endif
                
                <h3 class="text-2xl font-bold text-gray-900 mb-4">
                    {{ $data['right_heading'] ?? 'Right Column Heading' }}
                </h3>
                
                <p class="text-gray-600 leading-relaxed">
                    {{ $data['right_description'] ?? 'Description for the right column goes here.' }}
                </p>
            </div>
        </div>
    </div>
</section>