<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get some categories to assign to products
        $categories = Category::limit(5)->get();

        $products = [
            [
                'name' => 'Samsung Galaxy S24',
                'slug' => 'samsung-galaxy-s24',
                'name_en' => 'Samsung Galaxy S24',
                'description' => 'Latest Samsung flagship smartphone with advanced features',
                'short_description' => 'Premium Android smartphone with excellent camera',
                'price' => 89999.00,
                'compare_price' => 95999.00,
                'cost_price' => 75000.00,
                'stock_quantity' => 50,
                'track_stock' => true,
                'is_active' => true,
                'is_featured' => true,
                'weight' => 0.2,
                'dimensions' => '71.2 x 146.3 x 7.6 mm',
                'sort_order' => 1,
                'meta_title' => 'Samsung Galaxy S24 - Premium Smartphone',
                'meta_description' => 'Buy Samsung Galaxy S24 with best price in Bangladesh',
                'category_id' => $categories->isNotEmpty() ? $categories->random()->id : null,
            ],
            
        ];

        foreach ($products as $productData) {
            Product::create($productData);
        }
    }
}
