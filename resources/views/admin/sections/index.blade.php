{{-- resources/views/admin/sections/index.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Manage Sections</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
</head>
<body class="bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Manage Landing Page Sections</h1>
            <a href="{{ route('admin.sections.create') }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg transition">
                + Add New Section
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div id="sections-list" class="divide-y divide-gray-200">
                @forelse($sections as $section)
                    <div class="section-item p-6 hover:bg-gray-50 transition cursor-move" data-id="{{ $section->id }}">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4 flex-1">
                                <div class="text-gray-400">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">{{ $section->title }}</h3>
                                    <div class="flex items-center space-x-3 mt-1">
                                        <span class="text-sm text-gray-500">Type: <span class="font-medium">{{ str_replace('_', ' ', $section->type) }}</span></span>
                                        <span class="text-sm text-gray-400">•</span>
                                        <span class="text-sm {{ $section->is_active ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $section->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <a href="{{ route('admin.sections.edit', $section) }}" 
                                   class="text-blue-600 hover:text-blue-800 font-medium">
                                    Edit
                                </a>
                                <form action="{{ route('admin.sections.destroy', $section) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Are you sure you want to delete this section?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-12 text-center">
                        <p class="text-gray-500 text-lg">No sections created yet. Click "Add New Section" to get started!</p>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="mt-6 text-center">
            <a href="{{ route('landing') }}" target="_blank" class="text-blue-600 hover:text-blue-800 font-medium">
                → View Landing Page
            </a>
        </div>
    </div>

    <script>
        // Initialize Sortable for drag and drop reordering
        const el = document.getElementById('sections-list');
        const sortable = Sortable.create(el, {
            animation: 150,
            handle: '.section-item',
            onEnd: function() {
                const sections = [];
                document.querySelectorAll('.section-item').forEach((item, index) => {
                    sections.push({
                        id: item.dataset.id,
                        order: index
                    });
                });

                // Send AJAX request to update order
                fetch('{{ route("admin.sections.reorder") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ sections })
                });
            }
        });
    </script>
</body>
</html>