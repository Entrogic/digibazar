<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with('parent')
            ->withCount('children')
            ->ordered()
            ->paginate(15);

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parentCategories = Category::parentCategories()->active()->ordered()->get();

        return view('admin.categories.create', compact('parentCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255|unique:categories',
            'description' => 'nullable|string|max:1000',
            'parent_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'icon' => 'nullable|string|max:100',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ], [
            'name.required' => 'ক্যাটেগরির নাম প্রয়োজন।',
            'name.max' => 'ক্যাটেগরির নাম সর্বোচ্চ ২৫৫ অক্ষর হতে পারে।',
            'slug.unique' => 'এই স্লাগ ইতিমধ্যে ব্যবহৃত হয়েছে।',
            'parent_id.exists' => 'নির্বাচিত প্যারেন্ট ক্যাটেগরি বৈধ নয়।',
            'image.image' => 'ফাইলটি একটি ছবি হতে হবে।',
            'image.mimes' => 'ছবি jpeg, png, jpg, অথবা gif ফরম্যাটে হতে হবে।',
            'image.max' => 'ছবির সাইজ সর্বোচ্চ ২ MB হতে পারে।',
        ]);

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('categories', 'public');
        }

        // Set default values
        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        Category::create($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'ক্যাটেগরি সফলভাবে তৈরি হয়েছে।');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $category->load(['parent', 'children' => function ($query) {
            $query->withCount('children');
        }]);

        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $parentCategories = Category::parentCategories()
            ->active()
            ->where('id', '!=', $category->id)
            ->ordered()
            ->get();

        return view('admin.categories.edit', compact('category', 'parentCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('categories')->ignore($category->id)
            ],
            'description' => 'nullable|string|max:1000',
            'parent_id' => [
                'nullable',
                'exists:categories,id',
                function ($attribute, $value, $fail) use ($category) {
                    if ($value == $category->id) {
                        $fail('ক্যাটেগরি নিজেকে প্যারেন্ট হিসেবে সেট করতে পারে না।');
                    }
                }
            ],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'icon' => 'nullable|string|max:100',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ], [
            'name.required' => 'ক্যাটেগরির নাম প্রয়োজন।',
            'name.max' => 'ক্যাটেগরির নাম সর্বোচ্চ ২৫৫ অক্ষর হতে পারে।',
            'slug.unique' => 'এই স্লাগ ইতিমধ্যে ব্যবহৃত হয়েছে।',
            'parent_id.exists' => 'নির্বাচিত প্যারেন্ট ক্যাটেগরি বৈধ নয়।',
            'image.image' => 'ফাইলটি একটি ছবি হতে হবে।',
            'image.mimes' => 'ছবি jpeg, png, jpg, অথবা gif ফরম্যাটে হতে হবে।',
            'image.max' => 'ছবির সাইজ সর্বোচ্চ ২ MB হতে পারে।',
        ]);

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $validated['image'] = $request->file('image')->store('categories', 'public');
        }

        // Set default values
        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        $category->update($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'ক্যাটেগরি সফলভাবে আপডেট হয়েছে।');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // Check if category has children
        if ($category->hasChildren()) {
            return back()->with('error', 'এই ক্যাটেগরির সাব-ক্যাটেগরি রয়েছে। প্রথমে সেগুলো মুছুন।');
        }

        // Delete image if exists
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'ক্যাটেগরি সফলভাবে মুছে ফেলা হয়েছে।');
    }

    /**
     * Toggle category status
     */
    public function toggleStatus(Category $category)
    {
        $category->update(['is_active' => !$category->is_active]);

        $status = $category->is_active ? 'সক্রিয়' : 'নিষ্ক্রিয়';

        return back()->with('success', "ক্যাটেগরি {$status} করা হয়েছে।");
    }
}
