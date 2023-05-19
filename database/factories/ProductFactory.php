<?php

namespace Database\Factories;

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
            "name" => fake()->name(),
            "image" => fake()->imageUrl(640, 480, 'animals', true),
            "stock" => 1000,
            "price" => 200000,
            "desc" => fake()->sentence(100, true),
        ];
    }
}
