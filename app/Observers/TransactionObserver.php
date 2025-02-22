<?php

namespace App\Observers;

use App\Models\Customer;
use App\Models\Transaction;
use App\Models\Balance;
use App\Models\CustomerSaldo;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TransactionObserver
{

    /**
     * Saat Transaction dibuat, buat Balance dengan flow 'out' jika saldo cukup.
     */
    public function creating(Transaction $transaction)
    {
        $customer_id = $transaction->customer_id;

        // Ambil customer
        $customer = Customer::find($customer_id);

        if (!$customer) {
            throw new ModelNotFoundException("Customer tidak ditemukan.");
        }

        // Ambil saldo terbaru
        $customerSaldo = CustomerSaldo::where('customer_id', $customer->id)->first();

        if (!$customerSaldo || $customerSaldo->nominal < $transaction->amount) {
            throw new \Exception("Saldo tidak mencukupi untuk transaksi ini.");
        }
    }

    /**
     * Handle the Transaction "created" event.
     */
    public function created(Transaction $transaction): void
    {
        //jika status = success, buat Balance 'out'
        if ($transaction->status == 'success') {
            $this->createBalanceOut($transaction);
        }
    }

    /**
     * Handle the Transaction "updated" event.
     */
    public function updated(Transaction $transaction): void
    {
        //jika status = success, buat Balance 'out'
        if ($transaction->status == 'success') {
            $this->createBalanceOut($transaction);
        }
    }

    /**
     * Handle the Transaction "deleted" event.
     */
    public function deleted(Transaction $transaction): void
    {
        //
    }

    /**
     * Handle the Transaction "restored" event.
     */
    public function restored(Transaction $transaction): void
    {
        //
    }

    /**
     * Handle the Transaction "force deleted" event.
     */
    public function forceDeleted(Transaction $transaction): void
    {
        //
    }


    /**
     * Saat transaction status = success, buat Balance 'out'.
     */
    private function createBalanceOut(Transaction $transaction): void
    {
        Balance::create([
            'flow'              => 'out',
            'customer_id'       => $transaction->customer_id,
            'nominal'           => $transaction->price,
            'transaction_id'    => $transaction->id,
            'description'       => 'Transaksi ' . $transaction->ref_id,
        ]);
    }
}
