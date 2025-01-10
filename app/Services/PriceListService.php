<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\Product;

class PriceListService
{
  protected $apiUrl;
  protected $username;
  protected $apiKey;

  public function __construct()
  {
    $this->apiUrl = env('PRICELIST_API_URL');
    $this->username = env('USERNAME');
    $this->apiKey = env('API_KEY');
  }

  public function fetchPriceList()
  {
    $sign = md5($this->username . $this->apiKey . "pricelist");

    // Kirim data ke API tujuan
    $response = Http::post($this->apiUrl, [
      'cmd' => 'prepaid',
      'username' => $this->username,
      'sign' => $sign,
    ]);

    // Cek jika permintaan gagal
    if ($response->failed()) {
      return ['error' => 'Failed to relay request', 'details' => $response->json()];
    }

    // Ambil data dari respons API
    $data = $response->json();

    // Simpan data ke database
    Product::create([
      'product_name' => $data['product_name'] ?? '',
      'category' => $data['category'] ?? '',
      'brand' => $data['brand'] ?? '',
      'type' => $data['type'] ?? '',
      'seller_name' => $data['seller_name'] ?? '',
      'price' => $data['price'] ?? 0.00,
      'buyer_sku_code' => $data['buyer_sku_code'] ?? '',
      'buyer_product_status' => $data['buyer_product_status'] ?? true,
      'seller_product_status' => $data['seller_product_status'] ?? true,
      'unlimited_stock' => $data['unlimited_stock'] ?? true,
      'stock' => $data['stock'] ?? 0,
      'multi' => $data['multi'] ?? true,
      'start_cut_off' => $data['start_cut_off'] ?? '00:00:00',
      'end_cut_off' => $data['end_cut_off'] ?? '00:00:00',
      'desc' => $data['desc'] ?? null,
    ]);

    return $data;
  }
}
