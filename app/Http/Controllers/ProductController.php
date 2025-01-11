<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(20);
        $products->withPath('/products');
        return response()->json($products);
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
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

        $product = Product::create($request->all());
        return response()->json($product, 201);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

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
            'start_cut_off' => 'date_format:H:i:s',
            'end_cut_off' => 'date_format:H:i:s',
            'desc' => 'string',
        ]);

        $product->update($request->all());
        return response()->json($product);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(null, 204);
    }
}
