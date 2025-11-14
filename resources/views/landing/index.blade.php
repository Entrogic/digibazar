<main>
    @forelse($sections as $section)
        @includeIf('sections.' . $section->type, ['data' => $section->content])
    @empty
        <section class="py-20 text-center">
            <div class="max-w-7xl mx-auto px-4">
                <p class="text-gray-500 text-lg">No sections available yet. Please add sections from the admin panel.</p>
            </div>
        </section>
    @endforelse
</main>
