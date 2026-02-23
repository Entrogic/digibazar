@extends('layouts.admin')

@section('title', 'Section Management')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="mb-6">
            <a href="{{ route('admin.sections.index') }}" class="text-blue-600 hover:text-blue-800">
                ← Back to Sections
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-8">
            <h1 class="text-2xl font-bold text-gray-900 mb-6">
                {{ isset($section) ? 'Edit Section' : 'Create New Section' }}
            </h1>

            <form action="{{ isset($section) ? route('admin.sections.update', $section) : route('admin.sections.store') }}" 
                  method="POST" 
                  enctype="multipart/form-data"
                  id="section-form">
                @csrf
                @if(isset($section))
                    @method('PUT')
                @endif

                {{-- Title --}}
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Section Title</label>
                    <input type="text" 
                           name="title" 
                           value="{{ old('title', $section->title ?? '') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           required>
                    @error('title')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Type Selection --}}
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Section Type</label>
                    <select name="type" 
                            id="section-type"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            required>
                        <option value="">-- Select Type --</option>
                        <option value="text_image" {{ old('type', $section->type ?? '') == 'text_image' ? 'selected' : '' }}>
                            Text + Image (Text Left, Image Right)
                        </option>
                        <option value="image_text" {{ old('type', $section->type ?? '') == 'image_text' ? 'selected' : '' }}>
                            Image + Text (Image Left, Text Right)
                        </option>
                        <option value="youtube_iframe" {{ old('type', $section->type ?? '') == 'youtube_iframe' ? 'selected' : '' }}>
                            YouTube Video + Text
                        </option>
                        <option value="two_column_grid" {{ old('type', $section->type ?? '') == 'two_column_grid' ? 'selected' : '' }}>
                            Two Column Grid
                        </option>
                    </select>
                    @error('type')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Dynamic Content Fields --}}
                <div id="content-fields" class="mb-6">
                    <!-- Fields will be dynamically inserted here -->
                </div>

                {{-- Active Status --}}
                <div class="mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" 
                               name="is_active" 
                               {{ old('is_active', $section->is_active ?? true) ? 'checked' : '' }}
                               class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <span class="ml-2 text-sm text-gray-700">Active (show on landing page)</span>
                    </label>
                </div>

                {{-- Submit Button --}}
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('admin.sections.index') }}" 
                       class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        {{ isset($section) ? 'Update Section' : 'Create Section' }}
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection


@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

  <script>
        const sectionData = @json($section->content ?? []);

        // store editors
        const Editors = new Map();


        function initEditors(root = document) {
            root.querySelectorAll('textarea.js-ckeditor').forEach((ta) => {
                if (Editors.has(ta)) return;

                ClassicEditor
                    .create(ta, {
                        
                        // toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|', 'undo', 'redo' ]
                    })
                    .then(editor => Editors.set(ta, editor))
                    .catch(error => console.error(error));
            });
        }
        function destroyEditorsInside(container) {
            container.querySelectorAll('textarea.js-ckeditor').forEach((ta) => {
                const editor = Editors.get(ta);
                if (editor) {
                    editor.destroy();
                    Editors.delete(ta);
                }
            });
        }
        const templates = {
            text_image: `
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Heading</label>
                        <input type="text" name="content[heading]" value="${sectionData.heading || ''}" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea name="content[description]" rows="4" 
                                  class="js-ckeditor w-full px-4 py-2 border border-gray-300 rounded-lg" required>${sectionData.description || ''}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Image</label>
                        ${sectionData.image ? `<img src="/storage/${sectionData.image}" class="mb-2 h-24 rounded">` : ''}
                        <input type="file" name="content[image]" accept="image/*" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    </div>
                </div>
            `,
            image_text: `
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Heading</label>
                        <input type="text" name="content[heading]" value="${sectionData.heading || ''}" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea name="content[description]" rows="4" 
                                  class="js-ckeditor w-full px-4 py-2 border border-gray-300 rounded-lg" required>${sectionData.description || ''}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Image</label>
                        ${sectionData.image ? `<img src="/storage/${sectionData.image}" class="mb-2 h-24 rounded">` : ''}
                        <input type="file" name="content[image]" accept="image/*" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    </div>
                </div>
            `,
            youtube_iframe: `
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">YouTube Video URL</label>
                        <input type="text" name="content[youtube_id]" value="${sectionData.youtube_id || ''}" 
                               placeholder="e.g. https://youtu.be/....."
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                        <p class="text-xs text-gray-500 mt-1">Exact URL from Youtube. EX: https://youtu.be/zQniwPW7vUs</strong></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Heading</label>
                        <input type="text" name="content[heading]" value="${sectionData.heading || ''}" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea name="content[description]" rows="4" 
                                  class="js-ckeditor w-full px-4 py-2 border border-gray-300 rounded-lg" required>${sectionData.description || ''}</textarea>
                    </div>
                </div>
            `,
            two_column_grid: `
                <div class="space-y-6">
                    <div class="border-l-4 border-blue-500 pl-4">
                        <h3 class="font-semibold mb-3">Left Column</h3>
                        <div class="space-y-3">
                            <input type="text" name="content[left_heading]" value="${sectionData.left_heading || ''}" 
                                   placeholder="Left heading" class="w-full px-4 py-2 border rounded-lg" required>
                            <textarea name="content[left_description]" rows="3" placeholder="Left description"
                                      class="js-ckeditor w-full px-4 py-2 border rounded-lg" required>${sectionData.left_description || ''}</textarea>
                            <div>
                                <label class="block text-sm text-gray-600 mb-1">Icon (optional)</label>
                                ${sectionData.left_icon ? `<img src="/storage/${sectionData.left_icon}" class="mb-2 h-16 rounded">` : ''}
                                <input type="file" name="content[left_icon]" accept="image/*" 
                                       class="w-full px-4 py-2 border rounded-lg text-sm">
                            </div>
                        </div>
                    </div>
                    <div class="border-l-4 border-green-500 pl-4">
                        <h3 class="font-semibold mb-3">Right Column</h3>
                        <div class="space-y-3">
                            <input type="text" name="content[right_heading]" value="${sectionData.right_heading || ''}" 
                                   placeholder="Right heading" class="w-full px-4 py-2 border rounded-lg" required>
                            <textarea name="content[right_description]" rows="3" placeholder="Right description"
                                      class="js-ckeditor w-full px-4 py-2 border rounded-lg" required>${sectionData.right_description || ''}</textarea>
                            <div>
                                <label class="block text-sm text-gray-600 mb-1">Icon (optional)</label>
                                ${sectionData.right_icon ? `<img src="/storage/${sectionData.right_icon}" class="mb-2 h-16 rounded">` : ''}
                                <input type="file" name="content[right_icon]" accept="image/*" 
                                       class="w-full px-4 py-2 border rounded-lg text-sm">
                            </div>
                        </div>
                    </div>
                </div>
            `
        };

        function updateContentFields() {
            const type = document.getElementById('section-type').value;
            const container = document.getElementById('content-fields');
            destroyEditorsInside(container);

            if (type && templates[type]) {
                container.innerHTML = `
                    <div class="border-t pt-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Section Content</h3>
                        ${templates[type]}
                    </div>
                `;

                initEditors(container);
            } else {
                container.innerHTML = '';
            }
        }

        document.getElementById('section-type').addEventListener('change', updateContentFields);

        if (document.getElementById('section-type').value) {
            updateContentFields();
        }
        document.getElementById('section-form').addEventListener('submit', function () {
            for (const editor of Editors.values()) {
                editor.updateSourceElement(); 
            }
        });
    </script>
@endpush
