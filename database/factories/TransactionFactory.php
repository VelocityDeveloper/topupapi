<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;
use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Ambil semua produk
        $products = Product::all();

        // Ambil produk acak
        $product = $products->random();

        return [
            'ref_id'            => fake()->numerify('FAKE##########'),
            'customer_no'       => fake()->numerify('08##########'),
            'product_id'        => $product->id,
            'buyer_sku_code'    => $product->buyer_sku_code,
            'price'             => $product->price,
            'message'           => 'TEST',
            'status'            => fake()->randomElement(['success', 'failed', 'pending', 'success']),
            'testing'           => true,
            'created_at'        => Carbon::now()->subDays(rand(0, 30)), // Menghasilkan tanggal acak antara satu bulan kebelakang dan sekarang
            'updated_at'        => Carbon::now(),
        ];
    }
}
