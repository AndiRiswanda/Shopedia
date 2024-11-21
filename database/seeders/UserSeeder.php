<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
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
        
        $users = User::all(); // Get all users
        $products = Product::all(); // Get all products
        
        $users->each(function ($user) use ($products) {
            // 3-4 random products for each user
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
            'password' => static::$password ??= Hash::make('admin'),
            'remember_token' => Str::random(10),
        ]);

        
        User::create([
            'name' => 'Andi Riswanda',
            'email' => 'andiriswandalah@gmail.com',
            'email_verified_at' => now(),
            'role' => 'Buyer',
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        $user = User::create([
            'name' => 'Samsung Indonesia',
            'email' => 'samsung@example.com',
            'password' => Hash::make('samsung'),
            'role' => 'Seller',
        ]);

        
        $store = Store::create([
            'store_name' => 'Samsung Indonesia',
            'store_desc' => 'Indonesia Best Electronics.',
            'user_id' => $user->id,
        ]);

        
        
    }
}
