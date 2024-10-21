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
            'name' => $this->faker->name,
            'description' => $this->faker->paragraph,
            'price' => $this->faker->numberBetween(100000, 100000),
            'category' => $this->faker->randomElement(['motobike', 'helmet', 'apparel', 'fnb', 'additional']),
            'images' => $this->faker->imageUrl(),
            'media' => $this->faker->name,
        ];
    }
}
