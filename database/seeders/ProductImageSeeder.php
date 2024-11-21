<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductImage;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $products = Product::factory(10)->create();

        // $products->each(function ($product) {
        //     // Create 2-4 images per product
        //     ProductImage::factory(rand(2, 4))->create([
        //         'ProductID' => $product->id
        //     ]);
        // });
    }
}
