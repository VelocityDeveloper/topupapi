<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Transaction;
use App\Models\Customer;
use App\Models\Balance;

class BalanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua customer yang nama depannya diawali dengan 'xample-'
        $customers = Customer::where('domain', 'like', 'xample-%')->get();

        //jika kosong, tampilkan error
        if ($customers->isEmpty()) {
            $this->command->error('Tidak ada customer yang tersedia.');
            return;
        }

        foreach ($customers as $customer) {
            Balance::factory()->count(2)->create([
                'flow'        => 'in',
                'customer_id' => $customer->id,
                'description' => 'Topup Saldo Tester',
            ]);
        }
    }
}
