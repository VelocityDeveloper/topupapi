<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\ProductType;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = ProductType::paginate(20);
        $types->withPath('products/type');
        return response()->json($types);
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
            'type_name' => 'required|string|max:255',
            'type_description' => 'nullable|string|max:255',
            'type_logo_file' => 'nullable|image|max:2048',
        ]);

        //get by id
        $type = ProductType::find($id);

        //jika ada file type_logo_file
        if ($request->file('type_logo_file')) {

            //jika ada file type_logo_file sebelumnya
            if ($type->type_logo) {
                //hapus file type_logo_file sebelumnya
                Storage::disk('public')->delete($type->type_logo);
            }

            //upload file type_logo_file
            $path = $request->file('type_logo_file')->store('product-type', 'public');
            $type->type_logo = $path;
        }

        $type->update([
            'type_name' => $request->input('type_name'),
            'type_description' => $request->input('type_description'),
            'type_logo' => $type->type_logo
        ]);

        return response()->json($type);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
