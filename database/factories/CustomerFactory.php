<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_code' => 'XMPL' . fake()->randomNumber(5, true),
            'domain'        => 'xample-' . fake()->randomNumber(4, true) . fake()->domainName,
            'email'         => fake()->unique()->safeEmail(),
            'name'          => fake()->name(),
            'telepon'       => fake()->numerify('08##############'),
            'status'        => fake()->randomElement([1, 0, 1]),
        ];
    }
}
