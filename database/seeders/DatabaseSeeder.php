<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Review;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Wishlist;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use PhpParser\Lexer\TokenEmulator\ReverseEmulator;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            UserSeeder::class,
            ReviewSeeder::class,
            WishlistSeeder::class
        ]);
                    //Product count
        $productGenerated = 20;
        $products = Product::factory($productGenerated)->create();
        
        $products->each(function ($product) {

            Review::factory(max(2, rand(2, 4)))->create([
                'product_id' => $product->product_id,
                'user_id' => User::query()->inRandomOrder()->value('id') ?? User::factory()
            ]);

            ProductImage::factory(max(2, rand(2, 4)))->create([
                'product_id' => $product->product_id
            ]);

            CartDetail::factory(2)->create([
                'cart_id' => Cart::query()->inRandomOrder()->value('cart_id') ?? Cart::factory(),
                'product_id' => $product->product_id
            ]);

            
            
        });
    }
}
