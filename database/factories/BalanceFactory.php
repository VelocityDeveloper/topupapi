<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Balance>
 */
class BalanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Menggunakan Carbon untuk mendapatkan tanggal 10 hari kebelakang
        $tanggal = Carbon::now()->subDays(10);

        //nominal
        $nominal = fake()->numberBetween(100000, 5000000);
        $nominal = floor($nominal / 50000) * 50000;

        return [
            'flow'              => fake()->randomElement(['in', 'out']),
            'customer_id'       => fake()->numberBetween(1, 10),
            'nominal'           => $nominal,
            'description'       => fake()->sentence(),
            'date'              => $tanggal,
        ];
    }
}
