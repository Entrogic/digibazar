<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Example Attributes
        $attributes = [
            'Color' => ['Red', 'Blue', 'Green', 'Black', 'White'],
            'Size' => ['S', 'M', 'L', 'XL', 'XXL'],
            'Material' => ['Cotton', 'Polyester', 'Leather'],
        ];

        foreach ($attributes as $name => $values) {
            // Create Attribute
            $attribute = Attribute::create([
                'name' => $name,
                'slug' => strtolower($name),
            ]);

            // Create Attribute Values
            foreach ($values as $value) {
                AttributeValue::create([
                    'attribute_id' => $attribute->id,
                    'value' => $value,
                ]);
            }
        }
    }
}
