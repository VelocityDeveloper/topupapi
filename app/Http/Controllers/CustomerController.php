<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::paginate(20);
        $customers->withPath('/customer');
        return response()->json($customers);
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
            'name' => 'required|string|max:255',
            'domain' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'telepon' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);

        $customer = Customer::findOrFail($id);
        $customer->update($request->all());
        return response()->json($customer);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function get_key(string $id)
    {
        $customer = Customer::with('license:customer_id,secret_key')->select('id', 'customer_code')->find($id);
        return response()->json($customer);
    }

    public function generate_key(string $id)
    {
        $customer = Customer::with('license:customer_id,secret_key')->select('id', 'customer_code')->find($id);
        if ($customer->license->secret_key) {
            //generate ulang key
            $customer->license()->update(['secret_key' => Str::uuid()]);
        }
        return response()->json($customer);
    }
}
