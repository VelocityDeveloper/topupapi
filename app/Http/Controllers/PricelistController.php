<?php

namespace App\Http\Controllers;

use App\Models\Pricelist;
use Illuminate\Http\Request;

class PricelistController extends Controller
{
    public function index()
    {
        $pricelists = Pricelist::all();
        return response()->json($pricelists);
    }

    public function show($id)
    {
        $pricelist = Pricelist::findOrFail($id);
        return response()->json($pricelist);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'seller_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'buyer_sku_code' => 'required|string|max:255',
            'buyer_product_status' => 'boolean',
            'seller_product_status' => 'boolean',
            'unlimited_stock' => 'boolean',
            'stock' => 'integer',
            'multi' => 'boolean',
            'start_cut_off' => 'required|date_format:H:i',
            'end_cut_off' => 'required|date_format:H:i',
            'desc' => 'nullable|string',
        ]);

        $pricelist = Pricelist::create($request->all());
        return response()->json($pricelist, 201);
    }

    public function update(Request $request, $id)
    {
        $pricelist = Pricelist::findOrFail($id);

        $request->validate([
            'product_name' => 'string|max:255',
            'category' => 'string|max:255',
            'brand' => 'string|max:255',
            'type' => 'string|max:255',
            'seller_name' => 'string|max:255',
            'price' => 'numeric',
            'buyer_sku_code' => 'string|max:255',
            'buyer_product_status' => 'boolean',
            'seller_product_status' => 'boolean',
            'unlimited_stock' => 'boolean',
            'stock' => 'integer',
            'multi' => 'boolean',
            'start_cut_off' => 'date_format:H:i',
            'end_cut_off' => 'date_format:H:i',
            'desc' => 'string',
        ]);

        $pricelist->update($request->all());
        return response()->json($pricelist);
    }

    public function destroy($id)
    {
        $pricelist = Pricelist::findOrFail($id);
        $pricelist->delete();
        return response()->json(null, 204);
    }
}
