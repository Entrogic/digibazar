<?php
// app/Http/Controllers/SectionController.php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::ordered()->get();
        return view('admin.sections.index', compact('sections'));
    }

    public function create()
    {
        return view('admin.sections.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:text_image,image_text,youtube_iframe,two_column_grid',
            'content' => 'required|array',
        ]);

        try {
            // Handle image uploads
            $content = $validated['content'];
            if ($request->hasFile('content.image')) {
                $path = $request->file('content.image')->store('sections', 'public');
                $content['image'] = $path;
            }
            if ($request->hasFile('content.left_icon')) {
                $path = $request->file('content.left_icon')->store('sections', 'public');
                $content['left_icon'] = $path;
            }
            if ($request->hasFile('content.right_icon')) {
                $path = $request->file('content.right_icon')->store('sections', 'public');
                $content['right_icon'] = $path;
            }

            // Get the highest order and add 1
            $maxOrder = Section::max('order') ?? 0;

            Section::create([
                'title' => $validated['title'],
                'type' => $validated['type'],
                'content' => $content,
                'order' => $maxOrder + 1,
                'is_active' => $request->has('is_active'),
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', $th->getMessage());
        }


        return redirect()->route('admin.sections.index')
            ->with('success', 'Section created successfully!');
    }

    public function edit(Section $section)
    {
        return view('admin.sections.edit', compact('section'));
    }

    public function update(Request $request, Section $section)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:text_image,image_text,youtube_iframe,two_column_grid',
            'content' => 'required|array',
            'is_active' => 'boolean',
        ]);

        $content = $validated['content'];

        // Handle image uploads
        if ($request->hasFile('content.image')) {
            // Delete old image if exists
            if (isset($section->content['image'])) {
                Storage::disk('public')->delete($section->content['image']);
            }
            $path = $request->file('content.image')->store('sections', 'public');
            $content['image'] = $path;
        } elseif (isset($section->content['image'])) {
            $content['image'] = $section->content['image'];
        }

        if ($request->hasFile('content.left_icon')) {
            if (isset($section->content['left_icon'])) {
                Storage::disk('public')->delete($section->content['left_icon']);
            }
            $path = $request->file('content.left_icon')->store('sections', 'public');
            $content['left_icon'] = $path;
        } elseif (isset($section->content['left_icon'])) {
            $content['left_icon'] = $section->content['left_icon'];
        }

        if ($request->hasFile('content.right_icon')) {
            if (isset($section->content['right_icon'])) {
                Storage::disk('public')->delete($section->content['right_icon']);
            }
            $path = $request->file('content.right_icon')->store('sections', 'public');
            $content['right_icon'] = $path;
        } elseif (isset($section->content['right_icon'])) {
            $content['right_icon'] = $section->content['right_icon'];
        }

        $section->update([
            'title' => $validated['title'],
            'type' => $validated['type'],
            'content' => $content,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.sections.index')
            ->with('success', 'Section updated successfully!');
    }

    public function destroy(Section $section)
    {
        // Delete associated images
        if (isset($section->content['image'])) {
            Storage::disk('public')->delete($section->content['image']);
        }
        if (isset($section->content['left_icon'])) {
            Storage::disk('public')->delete($section->content['left_icon']);
        }
        if (isset($section->content['right_icon'])) {
            Storage::disk('public')->delete($section->content['right_icon']);
        }

        $section->delete();

        return redirect()->route('admin.sections.index')
            ->with('success', 'Section deleted successfully!');
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'sections' => 'required|array',
            'sections.*.id' => 'required|exists:sections,id',
            'sections.*.order' => 'required|integer',
        ]);

        foreach ($request->sections as $sectionData) {
            Section::where('id', $sectionData['id'])
                ->update(['order' => $sectionData['order']]);
        }

        return response()->json(['success' => true]);
    }
}
