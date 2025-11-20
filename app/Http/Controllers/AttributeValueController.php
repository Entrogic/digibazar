<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Http\Request;

class AttributeValueController extends Controller
{
    public function index(Attribute $attribute)
    {
        $values = $attribute->values()->latest()->get();
        return view('admin.attribute_values.index', compact('attribute', 'values'));
    }

    public function create(Attribute $attribute)
    {
        return view('admin.attribute_values.create', compact('attribute'));
    }

    public function store(Request $request, Attribute $attribute)
    {
        $request->validate([
            'value' => 'required'
        ]);

        $attribute->values()->create([
            'value' => $request->value
        ]);

        return redirect()->route('admin.values.index', $attribute->id)
                         ->with('success', 'Value added successfully!');
    }

    public function edit(Attribute $attribute, AttributeValue $value)
    {
        return view('admin.attribute_values.edit', compact('attribute', 'value'));
    }

    public function update(Request $request, Attribute $attribute, AttributeValue $value)
    {
        $request->validate([
            'value' => 'required'
        ]);

        $value->update([
            'value' => $request->value
        ]);

        return redirect()->route('admin.values.index', $attribute->id)
                         ->with('success', 'Value updated successfully!');
    }

    public function destroy(Attribute $attribute, AttributeValue $value)
    {
        $value->delete();

        return redirect()->route('admin.values.index', $attribute->id)
                         ->with('success', 'Value deleted successfully!');
    }
}
