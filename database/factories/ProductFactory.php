<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'product_name' => fake()->words(2, true), 
            'description' => fake()->sentence, // Afake description
            'price'       => fake()->randomFloat(2, 10, 1000), // Random price between 10 and 1000
            'stock'       => fake()->numberBetween(1, 100), // Random stock quantity
            'category_id'  => fake()->numberBetween(1, 10),
            'store_id' => Store::query()->inRandomOrder()->value('store_id') ?? Store::factory()

        ];
    }
}
