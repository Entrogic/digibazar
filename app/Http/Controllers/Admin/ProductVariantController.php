<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\ProductVariant;
use App\Models\ProductVariantValue;

class ProductVariantController extends Controller
{
    // Show create variant form
    public function create(Product $product)
    {
        $attributes = Attribute::with('values')->get();

        return view('admin.products.variants.create', compact('product', 'attributes'));
    }

    // Store variant
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'price.*' => 'required|numeric|min:0',
            'stock.*' => 'required|integer|min:0',
            'image.*' => 'nullable|image|max:2048',
            'attributes.*' => 'required|array',
        ]);

        foreach ($request->price as $index => $price) {
            // Handle image for this variant
            $imagePath = null;
            if ($request->hasFile('image') && isset($request->file('image')[$index])) {
                $image = $request->file('image')[$index];
                $imagePath = $image->store('product_variants', 'public');
            }

            // Create Product Variant
            $variant = ProductVariant::create([
                'product_id' => $product->id,
                'sku' => 'SKU-' . strtoupper(uniqid()),
                'price' => $price,
                'stock' => $request->stock[$index],
                'image' => $imagePath,
            ]);

            // Attach attribute values
            foreach ($request->input('attributes')[$index] as $attrId => $valueId) {
                ProductVariantValue::create([
                    'product_variant_id' => $variant->id,
                    'attribute_id' => $attrId,
                    'attribute_value_id' => $valueId,
                ]);
            }
        }

        return redirect()->route('admin.products.edit', $product->id)
            ->with('success', 'All product variants added successfully!');
    }
}
