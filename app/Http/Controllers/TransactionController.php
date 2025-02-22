<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Carbon\Carbon;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $customerId = $request->customer_id;
        $status = $request->status;
        $dates = $request->dates;
        $date_start =   '';
        $date_end = '';

        if ($dates) {
            //json to array
            $dates = json_decode($dates);
            $date_start = $dates[0] ? Carbon::parse($dates[0])->format('Y-m-d 00:00:00') : '';
            $date_end = $dates[1] ? Carbon::parse($dates[1])->format('Y-m-d 00:00:00') : '';
        }

        // Query transaksi dengan filter dan sorting
        $transactions = Transaction::with('customer')
            ->when($customerId, function ($query, $customerId) {
                return $query->where('customer_id', $customerId);
            })
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->when($date_start, function ($query, $date_start) {
                return $query->where('created_at', '>=', $date_start);
            })
            ->when($date_end, function ($query, $date_end) {
                return $query->where('created_at', '<=', $date_end);
            })
            ->orderBy('created_at', 'desc') // Sorting harus sebelum paginate()
            ->paginate(20)
            ->withPath('/transaction');

        return response()->json($transactions);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
