<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use Illuminate\Http\Request;
use Str;

class AttributeController extends Controller
{
    public function index()
    {
        $attributes = Attribute::latest()->get();
        return view('admin.attributes.index', compact('attributes'));
    }

    public function create()
    {
        return view('admin.attributes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:attributes,name'
        ]);

        Attribute::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        return redirect()->route('admin.attributes.index')
            ->with('success','Attribute created successfully!');
    }

    public function edit(Attribute $attribute)
    {
        return view('admin.attributes.edit', compact('attribute'));
    }

    public function update(Request $request, Attribute $attribute)
    {
        $request->validate([
            'name' => 'required|unique:attributes,name,' . $attribute->id
        ]);

        $attribute->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        return redirect()->route('admin.attributes.index')
            ->with('success','Attribute updated successfully!');
    }

    public function destroy(Attribute $attribute)
    {
        $attribute->delete();

        return redirect()->route('admin.attributes.index')
            ->with('success','Attribute deleted successfully!');
    }
}
