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



    public function getProductVariants(Request $request)
    {
        $variant = ProductVariant::where('product_id', $request->productId)->where('id', $request->variantId)->first();
        $product = Product::with('unit')->find($request->productId);

        return response()->json([
            'status' => 1,
            'data' => $variant,
            'unit_name' => $product->unit->name ?? 'টি'

        ]);
    }

    // Edit variant
    public function edit(Product $product, ProductVariant $variant)
    {
        $attributes = Attribute::with('values')->get();
        return view('admin.products.variants.edit', compact('product', 'variant', 'attributes'));
    }

    // Update variant
    public function update(Request $request, Product $product, ProductVariant $variant)
    {
        $request->validate([
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
            'attributes' => 'required|array',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($variant->image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($variant->image);
            }
            $variant->image = $request->file('image')->store('product_variants', 'public');
        }

        $variant->update([
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $variant->image,
        ]);

        // Update attribute values
        // First, remove existing values
        $variant->values()->delete();

        // Then add new values
        foreach ($request->input('attributes') as $attrId => $valueId) {
            ProductVariantValue::create([
                'product_variant_id' => $variant->id,
                'attribute_id' => $attrId,
                'attribute_value_id' => $valueId,
            ]);
        }

        return redirect()->route('admin.product.variants.create', $product->id)
            ->with('success', 'Product variant updated successfully!');
    }

    // Delete variant
    public function destroy(Product $product, ProductVariant $variant)
    {
        // Delete image
        if ($variant->image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($variant->image);
        }

        $variant->delete();

        return redirect()->back()->with('success', 'Variant deleted successfully.');
    }
}
