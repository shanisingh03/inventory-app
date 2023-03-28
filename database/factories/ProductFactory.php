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
            'name'  => fake()->name(),
            'sku'   => fake()->randomLetter().'-'.fake()->randomDigit(),
            'image' => "https://source.unsplash.com/random",
            'quantity'   => fake()->randomDigit(),
        ];
    }
}
