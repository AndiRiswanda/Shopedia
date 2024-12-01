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
            'category_name' => 'Figure & Collectibles',
            'category_desc' => 'Figurines, action figures, and collectible items.'
        ]);
        
        Category::create([
            'category_name' => 'Books',
            'category_desc' => 'Novels, textbooks, and magazines.'
        ]);
        
        Category::create([
            'category_name' => 'Health & Wellness',
            'category_desc' => 'Supplements, fitness equipment, and health products.'
        ]);
        
        
        Category::create([
            'category_name' => 'Pets',
            'category_desc' => 'Pet food, toys, and accessories.'
        ]);

    }
}
