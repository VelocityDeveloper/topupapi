<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PriceListService;

class PriceListController extends Controller
{
  protected $priceListService;

  public function __construct(PriceListService $priceListService)
  {
    $this->priceListService = $priceListService;
  }

  public function index(Request $request)
  {
    $result = $this->priceListService->fetchPriceList();

    if (isset($result['error'])) {
      return response()->json($result, 500);
    }

    return response()->json($result);
  }
}
