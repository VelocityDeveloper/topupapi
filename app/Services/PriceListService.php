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
    $this->username = env('API_USERNAME');
    $this->apiKey = env('API_KEY');
  }

  public function fetchPriceList()
  {
    $sign = md5($this->username . $this->apiKey . "pricelist");
    $message = [];

    $data = [
      'cmd' => 'prepaid',
      'username' => $this->username,
      'sign' => $sign
    ];

    $response = Http::post($this->apiUrl, $data);

    if ($response->failed()) {
      return ['error' => 'Failed to relay request', 'details' => $response->json()];
    }

    $datas = $response->json();
    $products = Product::save_datas($datas);
    return $products;
    // Product::where('status', 1)->update(['status' => 0]);

    // foreach ($datas['data'] as $data) {
    //   $proccess = Product::updateOrCreate(
    //     ['buyer_sku_code' => $data['buyer_sku_code']],
    //     array_merge($data, ['status' => 1])
    //   );
    //   $message[] = $proccess;
    // }
    // return $message;
  }
}
