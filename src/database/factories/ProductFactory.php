<?php

namespace Database\Factories;

use App\Models\ProductCategory;
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
    public function definition()
    {
        return [
            'is_active' => fake()->boolean(),
            'category_id' => ProductCategory::factory(),
            'stock' => fake()->numberBetween(1, 10),
            'name' => fake()->words(3, true),
            'description' => fake()->text(200),
            'identifier' => fake()->ean13(),
            'price' => $this->faker->randomFloat(3, 10, 200),
        ];
    }
}
