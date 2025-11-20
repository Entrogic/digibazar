<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandingComponent;
use App\Models\LandingSection;
use Illuminate\Http\Request;

class LandingComponentController extends Controller
{
    public function create(Request $request)
    {
        $section = LandingSection::findOrFail($request->section_id);
        return view('admin.components.create', compact('section'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'section_id' => 'required|exists:landing_sections,id',
            'type' => 'required|string',
            'settings' => 'required|json',
            'order' => 'nullable|integer',
        ]);

        LandingComponent::create($request->only('section_id', 'type', 'settings', 'order'));

        return redirect()->route('admin.sections.index')->with('success', 'Component added.');
    }

    public function edit(LandingComponent $component)
    {
        $section = $component->section;
        return view('admin.components.edit', compact('component', 'section'));
    }

    public function update(Request $request, LandingComponent $component)
    {
        $request->validate([
            'type' => 'required|string',
            'settings' => 'required|json',
            'order' => 'nullable|integer',
        ]);

        $component->update($request->only('type', 'settings', 'order'));

        return redirect()->route('admin.sections.index')->with('success', 'Component updated.');
    }

    public function destroy(LandingComponent $component)
    {
        $component->delete();
        return redirect()->route('admin.sections.index')->with('success', 'Component deleted.');
    }
}
