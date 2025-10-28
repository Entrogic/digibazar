<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Parent Categories
        $electronics = Category::create([
            'name' => 'ইলেকট্রনিক্স',
            'name_en' => 'Electronics',
            'slug' => 'electronics',
            'description' => 'সব ধরনের ইলেকট্রনিক পণ্য',
            'icon' => '📱',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $fashion = Category::create([
            'name' => 'ফ্যাশন',
            'name_en' => 'Fashion',
            'slug' => 'fashion',
            'description' => 'পোশাক ও ফ্যাশন পণ্য',
            'icon' => '👗',
            'is_active' => true,
            'sort_order' => 2,
        ]);

        $homeAppliances = Category::create([
            'name' => 'গৃহস্থালী',
            'name_en' => 'Home Appliances',
            'slug' => 'home-appliances',
            'description' => 'ঘরের যন্ত্রপাতি ও সামগ্রী',
            'icon' => '🏠',
            'is_active' => true,
            'sort_order' => 3,
        ]);

        $books = Category::create([
            'name' => 'বই ও শিক্ষা',
            'name_en' => 'Books & Education',
            'slug' => 'books-education',
            'description' => 'বই, খাতা ও শিক্ষা উপকরণ',
            'icon' => '📚',
            'is_active' => true,
            'sort_order' => 4,
        ]);

        $health = Category::create([
            'name' => 'স্বাস্থ্য ও সৌন্দর্য',
            'name_en' => 'Health & Beauty',
            'slug' => 'health-beauty',
            'description' => 'স্বাস্থ্য ও সৌন্দর্য পণ্য',
            'icon' => '💄',
            'is_active' => true,
            'sort_order' => 5,
        ]);

   

        $this->command->info('Category seeder completed successfully!');
        $this->command->line('Created categories:');
        $this->command->line('- 5 Parent categories');
        $this->command->line('- 12 Sub-categories');
        $this->command->line('Total: 17 categories');
    }
}
