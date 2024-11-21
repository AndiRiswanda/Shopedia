<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => Product::query()->inRandomOrder()->value('product_id') ?? Product::factory(), // Generate Product (di ProductFactory)
            'user_id' => User::factory(), // Generate User (di UserFactory)
            'rating' => $this->faker->numberBetween(1, 5), // Random rating between 1 and 5
            'comment' => $this->faker->sentence() // Generate a random comment
        ];
    }
}
