@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
    <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-xl font-bold mb-4">{{ $section->exists ? 'Edit Section' : 'Create Section' }}</h1>

        <form method="POST" action="{{ $section->exists ? route('admin.sections.update', $section) : route('admin.sections.store') }}">
            @csrf
            @if($section->exists) @method('PUT') @endif

            <div class="mb-4">
                <label class="block text-sm font-medium">Title (optional)</label>
                <input type="text" name="title" value="{{ old('title', $section->title) }}" class="mt-1 block w-full border rounded p-2" />
            </div>

            <div x-data="{ type: '{{ old('type', $section->type ?? '') }}' }">
                <div class="mb-4">
                    <label class="block text-sm font-medium">Type</label>
                    <select name="type" x-model="type" class="mt-1 block w-full border rounded p-2">
                        <option value="">-- Select a type --</option>
                        <option value="text_image">Text + Image (text left, image right)</option>
                        <option value="image_text">Image + Text (image left, text right)</option>
                        <option value="youtube_iframe">YouTube (iframe)</option>
                        <option value="two_column_grid">Two Column Grid</option>
                    </select>
                </div>

                <!-- text_image -->
                <div x-show="type === 'text_image'" x-cloak class="space-y-4 border p-4 rounded">
                    <h3 class="font-semibold">Text + Image</h3>
                    <label class="block text-sm">Heading</label>
                    <input name="heading" type="text" value="{{ old('heading', $section->content['heading'] ?? '') }}" class="mt-1 block w-full border rounded p-2" />
                    <label class="block text-sm">Body</label>
                    <textarea name="body" class="mt-1 block w-full border rounded p-2">{{ old('body', $section->content['body'] ?? '') }}</textarea>
                    <label class="block text-sm">Image URL</label>
                    <input name="image" type="url" value="{{ old('image', $section->content['image'] ?? '') }}" class="mt-1 block w-full border rounded p-2" />
                    <div class="grid grid-cols-2 gap-2">
                        <input name="button_text" type="text" placeholder="Button text" value="{{ old('button_text', $section->content['button_text'] ?? '') }}" class="mt-1 block w-full border rounded p-2" />
                        <input name="button_url" type="url" placeholder="Button URL" value="{{ old('button_url', $section->content['button_url'] ?? '') }}" class="mt-1 block w-full border rounded p-2" />
                    </div>
                </div>

                <!-- image_text -->
                <div x-show="type === 'image_text'" x-cloak class="space-y-4 border p-4 rounded">
                    <h3 class="font-semibold">Image + Text</h3>
                    <label class="block text-sm">Image URL</label>
                    <input name="image" type="url" value="{{ old('image', $section->content['image'] ?? '') }}" class="mt-1 block w-full border rounded p-2" />
                    <label class="block text-sm">Heading</label>
                    <input name="heading" type="text" value="{{ old('heading', $section->content['heading'] ?? '') }}" class="mt-1 block w-full border rounded p-2" />
                    <label class="block text-sm">Body</label>
                    <textarea name="body" class="mt-1 block w-full border rounded p-2">{{ old('body', $section->content['body'] ?? '') }}</textarea>
                    <div class="grid grid-cols-2 gap-2">
                        <input name="button_text" type="text" placeholder="Button text" value="{{ old('button_text', $section->content['button_text'] ?? '') }}" class="mt-1 block w-full border rounded p-2" />
                        <input name="button_url" type="url" placeholder="Button URL" value="{{ old('button_url', $section->content['button_url'] ?? '') }}" class="mt-1 block w-full border rounded p-2" />
                    </div>
                </div>

                <!-- youtube_iframe -->
                <div x-show="type === 'youtube_iframe'" x-cloak class="space-y-4 border p-4 rounded">
                    <h3 class="font-semibold">YouTube Iframe</h3>
                    <label class="block text-sm">YouTube URL (share or watch url)</label>
                    <input name="youtube_url" type="url" value="{{ old('youtube_url', $section->content['youtube_url'] ?? '') }}" class="mt-1 block w-full border rounded p-2" />
                    <label class="block text-sm">Heading</label>
                    <input name="heading" type="text" value="{{ old('heading', $section->content['heading'] ?? '') }}" class="mt-1 block w-full border rounded p-2" />
                    <label class="block text-sm">Body</label>
                    <textarea name="body" class="mt-1 block w-full border rounded p-2">{{ old('body', $section->content['body'] ?? '') }}</textarea>
                </div>

                <!-- two_column_grid -->
                <div x-show="type === 'two_column_grid'" x-cloak class="space-y-4 border p-4 rounded" x-data="{ columns: {{ json_encode(old('columns', $section->content['columns'] ?? [['title'=>'','body'=>'','icon'=>''],['title'=>'','body'=>'','icon'=>'']])) }} }">
                    <h3 class="font-semibold">Two Column Grid</h3>
                    <template x-for="(col, idx) in columns" :key="idx">
                        <div class="p-3 border rounded mb-2">
                            <div class="flex justify-between items-center mb-2">
                                <div class="text-sm font-medium">Column <span x-text="idx+1"></span></div>
                                <div>
                                    <button type="button" @click="columns.splice(idx,1)" class="px-2 py-1 text-sm border rounded">Remove</button>
                                </div>
                            </div>
                            <input :name="'columns['+idx+'][title]'" x-model="col.title" placeholder="Title" class="block w-full border rounded p-2 mb-2" />
                            <input :name="'columns['+idx+'][icon]'" x-model="col.icon" placeholder="Icon class or image URL" class="block w-full border rounded p-2 mb-2" />
                            <textarea :name="'columns['+idx+'][body]'" x-model="col.body" placeholder="Body" class="block w-full border rounded p-2"></textarea>
                        </div>
                    </template>

                    <div class="flex space-x-2">
                        <button type="button" @click="columns.push({title:'',body:'',icon:''})" class="px-3 py-1 border rounded">Add Column</button>
                        <button type="button" @click="columns = [{title:'',body:'',icon:''},{title:'',body:'',icon:''}]" class="px-3 py-1 border rounded">Reset to 2 columns</button>
                    </div>
                </div>

                <div class="mt-4">
                    <button class="px-4 py-2 bg-indigo-600 text-white rounded">Save Section</button>
                    <a href="{{ route('admin.sections.index') }}" class="ml-2 px-4 py-2 border rounded">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Alpine for dynamic form -->
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection
