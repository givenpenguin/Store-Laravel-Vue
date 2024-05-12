<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            'title' => fake()->title(),
            'article' => fake()->colorName(),
            'description' => fake()->text(),
            'preview_image' => 'images/a31oOQDZynNU8sVsM1fNh2dibPb5HIdQuAMPdJmO.webp',
            'price' => fake()->numberBetween(1000, 10000),
            'discount' => fake()->numberBetween(0, 100),
            'quantity' => fake()->numberBetween(1, 100),
            'category_id' => 1,
        ];
    }
}
