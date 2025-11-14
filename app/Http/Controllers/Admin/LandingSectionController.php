<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandingSection;
use Illuminate\Http\Request;

class LandingSectionController extends Controller
{
    public function index()
    {
        $sections = LandingSection::orderBy('order')->get();
        return view('admin.sections.index', compact('sections'));
    }

    public function create()
    {
        return view('admin.sections.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);

        LandingSection::create($request->only('title', 'order'));

        return redirect()->route('admin.sections.index')->with('success', 'Section created.');
    }

    public function edit(LandingSection $section)
    {
        return view('admin.sections.edit', compact('section'));
    }

    public function update(Request $request, LandingSection $section)
    {
        $request->validate([
            'title' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);

        $section->update($request->only('title', 'order'));

        return redirect()->route('admin.sections.index')->with('success', 'Section updated.');
    }

    public function destroy(LandingSection $section)
    {
        $section->delete();
        return redirect()->route('admin.sections.index')->with('success', 'Section deleted.');
    }
}
