<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{

    protected static ?string $password;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $users = User::all();
        $products = Product::all();
        
        $users->each(function ($user) use ($products) {
            // 3-4 random products (user)
            $user->wishlists()->createMany(
                $products->random(rand(3, 4))->map(function ($product) {
                    return ['product_id' => $product->id];
                })->toArray()
            );
        });

        User::create([
            'name' => 'ImTheAdmin',
            'email' => 'adminadmingod@gmail.com',
            'email_verified_at' => now(),
            'role' => 'Admin',
            'password' => Hash::make('admin'),
            'remember_token' => Str::random(10),
        ]);

        
        $user0 = User::create([
            'name' => 'Andi Riswanda',
            'email_verified_at' => now(),
            'email' => 'andi@example.com',
            'role' => 'Buyer',
            'password' => Hash::make('password'),
            'profile_url' => 'images/DefaultProfilePic/Shopedia Profile-05-01.png',
            'remember_token' => Str::random(10),
        ]);
        
        Cart::create([
            'user_id' => $user0->id,
        ]);

        $user = User::create([
            'name' => 'Samsung Indonesia',
            'email' => 'samsung@example.com',
            'password' => Hash::make('samsung'),
            'profile_url' => 'images/DefaultProfilePic/Shopedia Profile-05-01.png',
            'role' => 'Seller',
        ]);

        Cart::create([
            'user_id' => $user->id,
        ]);

        
        Store::create([
            'store_name' => 'Samsung Indonesia',
            'store_desc' => 'Indonesia Best Electronics.',
            'user_id' => $user->id,
            'profile_url' => 'store_profile_pics/DEFAULT DONT DELETE THIS PLEASE.jpg',
            'banner_url' => 'store_banners/DEFAULT DONT DELETE THIS PLEASE.jpg'
        ]);

        $user2 = User::create([
            'name' => 'Apple Indonesia',
            'email' => 'apple@example.com',
            'password' => Hash::make('apple'),
            'profile_url' => 'images/DefaultProfilePic/Shopedia Profile-05-01.png',
            'role' => 'Seller',
        ]);

        
        Cart::create([
            'user_id' => $user2->id,
        ]);

        Store::create([
            'store_name' => 'Apple Indonesia',
            'store_desc' => 'Indonesia Second Best Electronics. Lets goo buy it now people we def not scamming yall',
            'user_id' => $user2->id,
            'catch' => 'Indonesia Second Best Electronics.',
            'profile_url' => 'store_profile_pics/DEFAULT DONT DELETE THIS PLEASE.jpg',
            'banner_url' => 'store_banners/DEFAULT DONT DELETE THIS PLEASE.jpg'
        ]);

        
        
    }
}
