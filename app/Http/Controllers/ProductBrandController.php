<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\ProductBrand;

class ProductBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = ProductBrand::paginate(20);
        $brands->withPath('products/brand');
        return response()->json($brands);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'brand_name' => 'required|string|max:255',
            'brand_description' => 'nullable|string|max:255',
            'brand_logo_file' => 'nullable|image|max:2048',
        ]);

        //get by id
        $brand = ProductBrand::find($id);

        //jika ada file brand_logo_file
        if ($request->file('brand_logo_file')) {

            //jika ada file brand_logo_file sebelumnya
            if ($brand->brand_logo) {
                //hapus file brand_logo_file sebelumnya
                Storage::disk('public')->delete($brand->brand_logo);
            }

            //upload file brand_logo_file
            $path = $request->file('brand_logo_file')->store('product-brand', 'public');
            $brand->brand_logo = $path;
        }

        $brand->update([
            'brand_name' => $request->input('brand_name'),
            'brand_description' => $request->input('brand_description'),
            'brand_logo' => $brand->brand_logo
        ]);

        return response()->json($brand);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
