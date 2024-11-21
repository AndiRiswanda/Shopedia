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
        Category::create([
            'category_name' => 'Electronics',
            'category_desc' => 'Gadgets, devices, and accessories.'
        ]);
        
        Category::create([
            'category_name' => 'Fashion',
            'category_desc' => 'Clothing, shoes, and accessories.'
        ]);
        
        Category::create([
            'category_name' => 'Home & Kitchen',
            'category_desc' => 'Furniture, appliances, and cookware.'
        ]);
        
        Category::create([
            'category_name' => 'Books',
            'category_desc' => 'Novels, textbooks, and magazines.'
        ]);
        
        Category::create([
            'category_name' => 'Beauty & Personal Care',
            'category_desc' => 'Cosmetics, skincare, and grooming.'
        ]);
        
        Category::create([
            'category_name' => 'Sports & Outdoors',
            'category_desc' => 'Gear and equipment for outdoor activities.'
        ]);
        
        Category::create([
            'category_name' => 'Toys & Games',
            'category_desc' => 'Toys, puzzles, and board games for all ages.'
        ]);
        
        Category::create([
            'category_name' => 'Health & Wellness',
            'category_desc' => 'Supplements, fitness equipment, and health products.'
        ]);
        
        Category::create([
            'category_name' => 'Automotive',
            'category_desc' => 'Car accessories and tools.'
        ]);
        
        Category::create([
            'category_name' => 'Pets',
            'category_desc' => 'Pet food, toys, and accessories.'
        ]);

    }
}
