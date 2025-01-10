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
            'product_name' => $this->faker->sentence(6, true),
            'category' => $this->faker->word,
            'brand' => $this->faker->word,
            'type' => $this->faker->word,
            'seller_name' => $this->faker->company,
            'price' => $this->faker->numberBetween(10000, 50000),
            'buyer_sku_code' => $this->faker->unique()->word,
            'buyer_product_status' => $this->faker->boolean,
            'seller_product_status' => $this->faker->boolean,
            'unlimited_stock' => $this->faker->boolean,
            'stock' => $this->faker->numberBetween(0, 100),
            'multi' => $this->faker->boolean,
            'start_cut_off' => $this->faker->time(),
            'end_cut_off' => $this->faker->time(),
            'desc' => $this->faker->paragraph,
            'status' => $this->faker->boolean
        ];
    }
}
