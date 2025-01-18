<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\Customer;
use Pest\ArchPresets\Custom;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = Customer::factory()->count(20)->create();

        foreach ($customers as $customer) {
            //buat license
            $customer->license()->create([
                'secret_key' => Str::uuid(),
                'active' => true
            ]);

            //buat saldo
            $customer->saldo()->create([
                'nominal' => 0
            ]);
        }
    }
}
