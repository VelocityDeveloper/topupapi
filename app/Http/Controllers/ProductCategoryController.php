<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\ProductCategory;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = ProductCategory::paginate(20);
        // $category->withPath('products/category');
        // //tambahkan accessor LogoUrl
        // $category->each(function ($category) {
        //     $category->LogoUrl = Storage::url($category->category_logo);
        // });
        return response()->json($category);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
            'category_description' => 'nullable|string|max:255',
            'category_logo_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $category = ProductCategory::create($request->all());

        //jika ada file category_logo_file
        if ($request->hasFile('category_logo_file')) {
            $path = $request->input('category_logo_file')->store('product-category', 'public');
            $category->category_logo = $path;
            $category->save();
        }
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
            'category_name' => 'required|string|max:255',
            'category_description' => 'nullable|string|max:255',
            'category_logo_file' => 'nullable|image|max:2048',
        ]);

        //get by id
        $category = ProductCategory::find($id);

        //jika ada file category_logo_file
        if ($request->file('category_logo_file')) {

            //jika ada file category_logo_file sebelumnya
            if ($category->category_logo) {
                //hapus file category_logo_file sebelumnya
                Storage::disk('public')->delete($category->category_logo);
            }

            //upload file category_logo_file
            $path = $request->file('category_logo_file')->store('product-category', 'public');
            $category->category_logo = $path;
        }

        $category->update([
            'category_name' => $request->input('category_name'),
            'category_description' => $request->input('category_description'),
            'category_logo' => $category->category_logo
        ]);

        return response()->json($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
