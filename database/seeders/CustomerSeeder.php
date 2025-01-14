<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //buat 20 customer
        for ($i = 1; $i <= 20; $i++) {
            $customer = Customer::create([
                'domain' => 'contoh' . fake()->domainName,
                'email' => fake()->unique()->safeEmail(),
                'name' => fake()->name(),
                'telepon' => fake()->phoneNumber(),
                'status' => fake()->randomElement([1, 0]),
            ]);

            $customer->license()->create([
                'secret_key' => Str::uuid(),
                'active' => true
            ]);
        }
    }
}
