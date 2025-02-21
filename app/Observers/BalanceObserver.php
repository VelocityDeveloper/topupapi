<?php

namespace App\Observers;

use App\Models\Balance;
use App\Models\CustomerSaldo;

class BalanceObserver
{
    /**
     * Handle the Balance "created" event.
     */
    public function created(Balance $balance): void
    {
        //
        $this->updateCustomerSaldo($balance);
    }

    /**
     * Handle the Balance "updated" event.
     */
    public function updated(Balance $balance): void
    {
        //
        $this->updateCustomerSaldo($balance);
    }

    /**
     * Handle the Balance "deleted" event.
     */
    public function deleted(Balance $balance): void
    {
        //
        $this->updateCustomerSaldo($balance);
    }

    /**
     * Handle the Balance "restored" event.
     */
    public function restored(Balance $balance): void
    {
        //
        $this->updateCustomerSaldo($balance);
    }

    /**
     * Handle the Balance "force deleted" event.
     */
    public function forceDeleted(Balance $balance): void
    {
        //
        $this->updateCustomerSaldo($balance);
    }

    /**
     * Menghitung ulang saldo customer dan menyimpan ke CustomerSaldo.
     */
    private function updateCustomerSaldo(Balance $balance): void
    {
        $customer = $balance->customer;
        if (!$customer) return;

        // Hitung total saldo berdasarkan flow
        $total_in = $customer->balances()->where('flow', 'in')->sum('nominal');
        $total_out = $customer->balances()->where('flow', 'out')->sum('nominal');
        $saldo_akhir = $total_in - $total_out;

        // Update atau buat saldo customer
        CustomerSaldo::updateOrCreate(
            ['customer_id' => $customer->id],
            ['nominal' => $saldo_akhir]
        );
    }
}
