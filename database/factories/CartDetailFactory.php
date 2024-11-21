<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use App\Models\Cart;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CartDetail>
 */
class CartDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $product = Product::query()->inRandomOrder()->first() ?? Product::factory()->create();

        $quantity = $this->faker->numberBetween(1, 10); // random 1 and 10

        return [
            'cart_id' => Cart::query()->inRandomOrder()->value('cart_id') ?? Cart::factory(),
            'product_id' => $product->id,
            'quantity' => $quantity,
            'subtotal' => $quantity * $product->price
        ];
    }
}
