<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Product::factory()->count(10)->create();

        // Ambil data JSON dari file
        $json = File::get(database_path('seeders/products.json'));
        $products = json_decode($json, true);

        foreach ($products as $data) {
            Product::save_product($data);
        }
    }
}
