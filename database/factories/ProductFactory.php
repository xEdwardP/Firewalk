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
            'code' => $this->faker->unique()->numerify('#####'),
            'name' => $this->faker->unique()->word(),
            'description' => $this->faker->sentence(),
            'product_image' => $this->faker->imageUrl(640, 480, 'products', true),
            'purchase_price' => $this->faker->randomFloat(2, 10, 100),
            'selling_price' => $this->faker->randomFloat(2, 15, 150),
            'min_stock' => $this->faker->numberBetween(1, 5),
            'max_stock' => $this->faker->numberBetween(10, 20),
            'presentation' => $this->faker->randomElement(['unidad', 'caja', 'paquete']),
            'is_active' => $this->faker->boolean(90),
            'category_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
