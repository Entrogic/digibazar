<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
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
            [
                'name' => 'iPhone 15 Pro',
                'slug'=> 'iphone-15-pro',
                'name_en' => 'iPhone 15 Pro',
                'description' => 'Apple iPhone 15 Pro with titanium design and A17 Pro chip',
                'short_description' => 'Premium iPhone with titanium build',
                'price' => 149999.00,
                'compare_price' => 159999.00,
                'cost_price' => 120000.00,
                'stock_quantity' => 25,
                'track_stock' => true,
                'is_active' => true,
                'is_featured' => true,
                'weight' => 0.19,
                'dimensions' => '70.6 x 146.6 x 8.25 mm',
                'sort_order' => 2,
                'meta_title' => 'iPhone 15 Pro - Apple Smartphone',
                'meta_description' => 'Latest iPhone 15 Pro available in Bangladesh',
                'category_id' => $categories->isNotEmpty() ? $categories->random()->id : null,
            ],
            [
                'name' => 'Dell XPS 13 Laptop',
                "slug" => "dell-xps-13-laptop",
                'name_en' => 'Dell XPS 13 Laptop',
                'description' => 'Ultra-portable laptop with Intel Core i7 processor and premium build quality',
                'short_description' => '13-inch premium ultrabook for professionals',
                'price' => 125000.00,
                'compare_price' => 135000.00,
                'cost_price' => 100000.00,
                'stock_quantity' => 15,
                'track_stock' => true,
                'is_active' => true,
                'is_featured' => false,
                'weight' => 1.2,
                'dimensions' => '296 x 199 x 14.8 mm',
                'sort_order' => 3,
                'meta_title' => 'Dell XPS 13 Laptop - Premium Ultrabook',
                'meta_description' => 'Dell XPS 13 laptop with Intel Core i7 in Bangladesh',
                'category_id' => $categories->isNotEmpty() ? $categories->random()->id : null,
            ],
            [
                'name' => 'Sony WH-1000XM5 Headphones',
                'slug'=> 'sony-wh-1000xm5-headphones',
                'name_en' => 'Sony WH-1000XM5 Headphones',
                'description' => 'Industry-leading noise canceling wireless headphones',
                'short_description' => 'Premium noise-canceling headphones',
                'price' => 35000.00,
                'compare_price' => 38000.00,
                'cost_price' => 28000.00,
                'stock_quantity' => 30,
                'track_stock' => true,
                'is_active' => true,
                'is_featured' => true,
                'weight' => 0.25,
                'dimensions' => 'N/A',
                'sort_order' => 4,
                'meta_title' => 'Sony WH-1000XM5 - Noise Canceling Headphones',
                'meta_description' => 'Sony WH-1000XM5 wireless headphones in Bangladesh',
                'category_id' => $categories->isNotEmpty() ? $categories->random()->id : null,
            ],
            [
                'name' => 'Apple MacBook Air M2',
                'slug' => 'apple-macbook-air-m2',
                'name_en' => 'Apple MacBook Air M2',
                'description' => 'Apple MacBook Air with M2 chip, 8GB RAM, and 256GB SSD',
                'short_description' => 'Lightweight laptop with M2 chip',
                'price' => 135000.00,
                'compare_price' => 145000.00,
                'cost_price' => 115000.00,
                'stock_quantity' => 8,
                'track_stock' => true,
                'is_active' => true,
                'is_featured' => true,
                'weight' => 1.24,
                'dimensions' => '304.1 x 215 x 11.3 mm',
                'sort_order' => 5,
                'meta_title' => 'MacBook Air M2 - Apple Laptop',
                'meta_description' => 'Apple MacBook Air with M2 chip available in Bangladesh',
                'category_id' => $categories->isNotEmpty() ? $categories->random()->id : null,
            ],
        ];

        foreach ($products as $productData) {
            Product::create($productData);
        }
    }
}
